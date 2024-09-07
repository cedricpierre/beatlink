<?php

namespace App\Services\Music\Models;

class Playlist
{
    public function __construct(public string|int $id, public string $name, public string $url)
    {
    }
}
