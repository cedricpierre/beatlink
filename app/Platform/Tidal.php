<?php

namespace App\Platform;

use App\Platform\Concerns\PlatformServiceConcern;
use App\Platform\Responses\PlatformSearchResponse;
use App\Platform\Types\Album;
use App\Platform\Types\Artist;
use App\Platform\Types\Author;
use App\Platform\Types\Playlist;
use App\Platform\Types\Track;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

class Tidal implements PlatformServiceConcern
{
    private const TIDAL_API_TOKEN_URL = 'https://auth.tidal.com/v1/oauth2/token';
    private const TIDAL_SEARCH_URL    = 'https://openapi.tidal.com/v2/searchresults';
    private const CACHE_PREFIX        = 'tidal';

    public function search(string $lookup): PlatformSearchResponse
    {
        $this->getAccessToken();

        $client = new Client();

        try {
            $response = $client->get(self::TIDAL_SEARCH_URL . '/' . $lookup . '?countryCode=US&include=artists&include=tracks&include=albums&limit=100',
                                     [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'Accept'        => 'application/vnd.api+json',
                ],
            ]);
        } catch (RequestException $e) {
            dd($e);
        }

        $body = Json::decode((string)$response->getBody(), false);

        $included = collect($body->included ?? []);

        /** @var Track[] $albums */
        $tracks = collect();
        $artists = collect();
        $albums = collect();

        $included->each(function ($item) use (&$tracks, &$artists, &$albums) {
            switch ($item->type) {
                case 'tracks':
                    $tracks->push(new Track($item->id, $item->attributes->title, $item->attributes->externalLinks[0]->href));
                    break;
                case 'artists':
                    $artists->push(new Artist($item->id, $item->attributes->name, $item->attributes->externalLinks[0]->href));
                    break;
                case 'albums':
                    $albums->push(new Album($item->id, $item->attributes->title, $item->attributes->externalLinks[0]->href));
                    break;

            }
        });


        return new PlatformSearchResponse([
                                              'tracks'  => $tracks,
                                              'artists' => $artists,
                                              'albums'  => $albums,
                                          ]);
    }

    public function getAccessToken(): string
    {
        if (!Cache::has(self::CACHE_PREFIX . '.accessToken')) {
            $this->generateAccessToken();
        }

        return Cache::get(self::CACHE_PREFIX . '.accessToken');
    }

    private function generateAccessToken(): void
    {
        try {
            $client = new Client();
            $response = $client->post(self::TIDAL_API_TOKEN_URL, [
                'headers'     => [
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                    'Accepts'       => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('platforms.tidal.client_id') . ':' . config('platforms.tidal.client_secret')),
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = Json::decode($e->getResponse()?->getBody()->getContents(), false);
            $status = $e->getCode();

            $message = $errorResponse->error;

            dd($e->getMessage());
            throw new RuntimeException($message, $status);
        }

        $body = Json::decode((string)$response->getBody(), false);

        Cache::remember(self::CACHE_PREFIX . '.accessToken', $body->expires_in, function () use ($body) {
            return $body->access_token;
        });
    }
}
