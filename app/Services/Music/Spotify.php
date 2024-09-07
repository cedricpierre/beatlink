<?php

namespace App\Services\Music;

use App\Services\Music\Concerns\MusicServiceConcern;
use App\Services\Music\Models\Artist;
use App\Services\Music\Models\Playlist;
use App\Services\Music\Models\Song;
use App\Services\Music\Responses\MusicSearchJsonResponse;

class Spotify implements MusicServiceConcern
{
    public function search(string $lookup): MusicSearchJsonResponse
    {
        $artists = [
            new Artist(1, 'Test Artist', 'http://sqsdqsd2.com'),
            new Artist(2, 'Test Artist2', 'http://sqsdqsd3.com'),
            new Artist(3, 'Test Artist3', 'http://sqsdqsd4.com'),
            new Artist(4, 'Test Artist3', 'http://sqsdqsd5.com'),
        ];

        $playlists = [
            new Playlist(1, 'test', 'http://sdsdfs.com'),
            new Playlist(1, 'test', 'http://sdsdfs.com'),
            new Playlist(1, 'test', 'http://sdsdfs.com'),
            new Playlist(1, 'test', 'http://sdsdfs.com'),
        ];

        $songs = [
            new Song(1, 'test', 'http://sdsdfs.com', new Artist(1, 'qdqsd', 'http://qsqsd.com')),
            new Song(1, 'test', 'http://sdsdfs.com', new Artist(1, 'qdqsd', 'http://qsqsd.com')),
            new Song(1, 'test', 'http://sdsdfs.com', new Artist(1, 'qdqsd', 'http://qsqsd.com')),
            new Song(1, 'test', 'http://sdsdfs.com', new Artist(1, 'qdqsd', 'http://qsqsd.com')),
        ];

        return new MusicSearchJsonResponse($artists, $playlists, $songs);
    }
}
