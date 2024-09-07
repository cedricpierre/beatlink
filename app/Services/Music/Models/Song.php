<?php

namespace App\Services\Music\Models;

class Song
{
    public function __construct(public string|int $id, public string $name, public string $url, public Artist $artist)
    {
    }
}
