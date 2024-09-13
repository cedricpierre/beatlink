<?php

namespace App\Platform\Types;

use App\Platform\Contracts\PlatformTypeContract;

class Picture
{

    public string|null $url;
    public int|null    $width;
    public int|null    $height;

    public function __construct(string|null $url, int|null $width = null, int|null $height = null)
    {

        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }
}
