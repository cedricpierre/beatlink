<?php

namespace App\Platform\Types;

use App\Platform\Contracts\PlatformTypeContract;

class Author
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
