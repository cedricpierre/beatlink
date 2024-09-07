<?php

namespace App\Services\Music\Concerns;

use App\Services\Music\Responses\MusicSearchJsonResponse;

interface MusicServiceConcern
{
    public function search(string $lookup): MusicSearchJsonResponse;
}
