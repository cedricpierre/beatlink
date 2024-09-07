<?php

namespace App\Services\Music\Responses;

use Illuminate\Http\JsonResponse;

class MusicSearchJsonResponse extends JsonResponse
{
    protected array $artists   = [];
    protected array $playlists = [];
    protected array $songs     = [];

    public function __construct($artists, $playlists, $songs)
    {
        $this->artists = $artists;
        $this->playlists = $playlists;
        $this->songs = $songs;

        parent::__construct([
                                'artists'   => $this->artists,
                                'playlists' => $this->playlists,
                                'songs'     => $this->songs,
                            ]);
    }
}
