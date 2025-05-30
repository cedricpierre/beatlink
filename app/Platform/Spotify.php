<?php

namespace App\Platform;

use App\Platform\Concerns\PlatformServiceConcern;
use App\Platform\Responses\PlatformSearchResponse;
use App\Platform\Types\Album;
use App\Platform\Types\Artist;
use App\Platform\Types\Author;
use App\Platform\Types\Picture;
use App\Platform\Types\Playlist;
use App\Platform\Types\Track;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

class Spotify implements PlatformServiceConcern
{
    private const SPOTIFY_API_TOKEN_URL = 'https://accounts.spotify.com/api/token';
    private const SPOTIFY_SEARCH_URL    = 'https://api.spotify.com/v1/search';
    private const CACHE_PREFIX          = 'spotify';

    public function search(string $lookup): PlatformSearchResponse
    {
        $client = new Client();

        try {

            $response = $client->get(self::SPOTIFY_SEARCH_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                ],
                'query'   => [
                    'q'     => $lookup,
                    'type'  => 'track,artist,album,playlist',
                    'limit' => 30,
                ]
            ]);
        } catch (GuzzleException $e) {
            return new PlatformSearchResponse();
        }

        $body = Json::decode((string)$response->getBody(), false);

        /** @var Album[] $albums */
        $albums = collect($body->albums->items)->map(function ($item) {
            return new Album(
                $item->id,
                $item->name,
                $item->external_urls->spotify,
                picture: isset($item->images[0]) ? new Picture($item->images[0]->url, $item->images[0]->width, $item->images[0]->height) : null,
                author : isset($item->artists[0]) ? new Author($item->artists[0]->name) : null,
            );
        });

        /** @var Artist[] $albums */
        $artists = collect($body->artists->items)->map(function ($item) {
            return new Artist(
                $item->id,
                $item->name,
                $item->external_urls->spotify,
                picture: isset($item->images[0]) ? new Picture($item->images[0]->url, $item->images[0]->width, $item->images[0]->height) : null,
                author : isset($item->artists[0]) ? new Author($item->artists[0]->name) : null,
            );
        });

        /** @var Track[] $albums */
        $tracks = collect($body->tracks->items)->map(function ($item) {
            return new Track(
                         $item->id,
                         $item->name,
                         $item->external_urls->spotify,
                picture: isset($item->images[0]) ? new Picture($item->images[0]->url, $item->images[0]->width, $item->images[0]->height) : null,
                author : isset($item->artists[0]) ? new Author($item->artists[0]->name) : null,
            );
        });

        /** @var Playlist[] $albums */
        $playlists = collect($body->playlists->items)->map(function ($item) {
            return new Playlist(
                         $item->id,
                         $item->name,
                         $item->external_urls->spotify,
                picture: isset($item->images[0]) ? new Picture($item->images[0]->url, $item->images[0]->width, $item->images[0]->height) : null,
                author : isset($item->artists[0]) ? new Author($item->artists[0]->name) : null,

            );
        });

        return new PlatformSearchResponse([
                                              'albums'    => $albums,
                                              'artists'   => $artists,
                                              'tracks'    => $tracks,
                                              'playlists' => $playlists
                                          ]);
    }

    private function getAccessToken(): string
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
            $response = $client->post(self::SPOTIFY_API_TOKEN_URL, [
                'headers'     => [
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                    'Accepts'       => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('platforms.spotify.client_id') . ':' . config('platforms.spotify.client_secret')),
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = Json::decode($e->getResponse()?->getBody()->getContents(), false);
            $status = $e->getCode();

            $message = $errorResponse->error;

            throw new RuntimeException($message, $status);
        }

        $body = Json::decode((string)$response->getBody(), false);

        Cache::remember(self::CACHE_PREFIX . '.accessToken', $body->expires_in, function () use ($body) {
            return $body->access_token;
        });
    }

}
