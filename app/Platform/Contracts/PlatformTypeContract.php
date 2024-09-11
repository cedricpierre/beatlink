<?php

namespace App\Platform\Contracts;

use App\Platform\Types\Picture;

class PlatformTypeContract
{
    public string|int $id;
    public string     $name;
    public string     $url;
    public ?string  $description = null;
    public ?Picture $picture     = null;

    public function __construct(string|int $id, string $name, string $url, ?string $description = null, ?Picture $picture = null)
    {
        $this->description = $description;
        $this->url = $url;
        $this->name = $name;
        $this->picture = $picture;
        $this->id = $id;
    }
}
