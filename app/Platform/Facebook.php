<?php

namespace App\Platform;

use App\Platform\Concerns\PlatformServiceConcern;
use App\Platform\Responses\PlatformSearchResponse;
use App\Platform\Types\Group;
use App\Platform\Types\Page;
use Laravel\Prompts\Concerns\Events;

class Facebook implements PlatformServiceConcern
{
    public function search(string $lookup): PlatformSearchResponse
    {
        /** @var Group[] $artists */
        $groups = [];

        /** @var Page[] $artists */
        $pages = [];

        /** @var Events[] $artists */
        $events = [];

        return new PlatformSearchResponse(['groups' => $groups, 'pages' => $pages, 'events' => $events]);
    }
}
