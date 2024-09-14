<?php

namespace App\Platform;

use App\Platform\Concerns\PlatformServiceConcern;
use App\Platform\Responses\PlatformSearchResponse;
use App\Platform\Types\Album;
use App\Platform\Types\Author;
use App\Platform\Types\Group;
use App\Platform\Types\Page;
use App\Platform\Types\Picture;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Cache;
use Laravel\Prompts\Concerns\Events;
use RuntimeException;

class Facebook implements PlatformServiceConcern
{
    private const FACEBOOK_API_TOKEN_URL = 'https://graph.facebook.com/oauth/access_token';
    private const FACEBOOK_SEARCH_URL    = 'https://graph.facebook.com/pages/search';
    private const CACHE_PREFIX           = 'spotify';


    public function search(string $lookup): PlatformSearchResponse
    {
        $client = new Client();

        try {

            $response = $client->get(self::FACEBOOK_SEARCH_URL, [
                'query' => [
                    'q'            => $lookup,
                    'type'         => 'id,name,location,link',
                    'access_token' => $this->getAccessToken(),
                ]
            ]);
        } catch (RequestException $e) {
            dd($e);
        }


        $body = Json::decode((string)$response->getBody(), false);

        dd($body);
        /** @var Page[] $albums */
        $pages = collect($body->albums->items)->map(function ($item) {
            return new Page(
                         $item->id,
                         $item->name,
                         $item->external_urls->spotify,
                picture: isset($item->images[0]) ? new Picture($item->images[0]->url, $item->images[0]->width, $item->images[0]->height) : null,
                author : isset($item->artists[0]) ? new Author($item->artists[0]->name) : null,
            );
        });


        return new PlatformSearchResponse(['pages' => $pages]);
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
            $response = $client->post(self::FACEBOOK_API_TOKEN_URL, [
                'headers'     => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accepts'      => 'application/json',
                ],
                'form_params' => [
                    'client_id'     => config('platforms.facebook.client_id'),
                    'client_secret' => config('platforms.facebook.client_secret'),
                    'grant_type'    => 'client_credentials',
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = Json::decode($e->getResponse()?->getBody()->getContents(), false);
            $status = $e->getCode();

            $message = $errorResponse->error;

            throw new RuntimeException($message, $status);
        }

        $body = Json::decode((string)$response->getBody(), false);

        Cache::remember(self::CACHE_PREFIX . '.accessToken', 60 * 60, function () use ($body) {
            return $body->access_token;
        });
    }
}
