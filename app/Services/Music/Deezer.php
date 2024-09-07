<?php

namespace App\Services\Music;

use App\Services\Music\Concerns\MusicServiceConcern;
use App\Services\Music\Models\Artist;
use App\Services\Music\Models\Playlist;
use App\Services\Music\Models\Song;
use App\Services\Music\Responses\MusicSearchJsonResponse;

class Deezer implements MusicServiceConcern
{
    public function search(string $lookup): MusicSearchJsonResponse
    {
        $artists = [];

        $playlists = [];

        $songs = [];

        return new MusicSearchJsonResponse($artists, $playlists, $songs);
    }
}
