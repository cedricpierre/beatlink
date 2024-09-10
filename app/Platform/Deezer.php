<?php

namespace App\Platform;

use App\Platform\Concerns\PlatformServiceConcern;
use App\Platform\Responses\PlatformSearchResponse;
use App\Platform\Types\Artist;
use App\Platform\Types\Playlist;
use App\Platform\Types\Track;

class Deezer implements PlatformServiceConcern
{
    public function search(string $lookup): PlatformSearchResponse
    {
        /** @var Artist[] $artists */
        $artists = [];

        /** @var Track[] $artists */
        $songs = [];

        /** @var Playlist[] $artists */
        $playlists = [];

        return new PlatformSearchResponse(['artists' => $artists, 'songs' => $songs, 'playlists' => $playlists]);
    }
}
