<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Link;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->url,
            'platform_id' => Platform::all()->random()->id,
        ];
    }
}
