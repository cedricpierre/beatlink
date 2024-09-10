<?php

namespace App\Platform;

use App\Platform\Concerns\PlatformServiceConcern;
use App\Platform\Responses\PlatformSearchResponse;
use App\Platform\Types\Artist;
use App\Platform\Types\Playlist;
use App\Platform\Types\Track;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Casts\Json;
use RuntimeException;

class Deezer implements PlatformServiceConcern
{
    private const DEEZER_SEARCH_URL = 'https://api.deezer.com/search';

    public function search(string $lookup): PlatformSearchResponse
    {
        $client = new Client();

        try {

            $response = $client->get(self::DEEZER_SEARCH_URL, [
                'query' => [
                    'q' => $lookup,
                ]
            ]);
        } catch (RequestException $e) {
            throw new RuntimeException($e->getMessage());
        }

        $body = Json::decode((string)$response->getBody(), false);

        $tracks = collect($body->data)->map(function ($item) {
            return new Track($item->id, $item->title, $item->link, new Artist($item->artist->id, $item->artist->name, $item->artist->link));
        });

        return new PlatformSearchResponse(['tracks' => $tracks]);
    }
}
