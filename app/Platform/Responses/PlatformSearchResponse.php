<?php

namespace App\Platform\Responses;

use App\Platform\Contracts\PlatformTypeContract;
use Illuminate\Contracts\Support\Arrayable;

class PlatformSearchResponse implements Arrayable
{
    /**
     * @var PlatformTypeContract[]
     */
    protected mixed $data;

    public function __construct(mixed $data)
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
