<?php

namespace App\Platform\Types;

use App\Platform\Contracts\PlatformTypeContract;

class Track extends PlatformTypeContract
{
    public ?Author $author;

    /**
     * @param int|string $id
     * @param string $name
     * @param string $url
     * @param Author|null $author
     * @param string|null $description
     */
    public function __construct(int|string $id, string $name, string $url, ?Author $author = null, ?string $description = null)
    {
        $this->author = $author;

        parent::__construct($id, $name, $url, $description);
    }
}
