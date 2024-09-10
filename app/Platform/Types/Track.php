<?php

namespace App\Platform\Types;

use App\Platform\Contracts\PlatformTypeContract;

class Track extends PlatformTypeContract
{
    protected Artist $artist;

    /**
     * @param int|string $id
     * @param string $name
     * @param string $url
     * @param Artist $artist
     * @param string|null $description
     */
    public function __construct(int|string $id, string $name, string $url, Artist $artist, ?string $description = null)
    {
        $this->artist = $artist;

        parent::__construct($id, $name, $url, $description);
    }
}
