<?php

namespace App\Platform\Concerns;

use App\Platform\Responses\PlatformSearchResponse;

/**
 * @property $clientId
 * @property $clientSecret
 */
interface PlatformServiceConcern
{
    public function search(string $lookup): PlatformSearchResponse;

}
