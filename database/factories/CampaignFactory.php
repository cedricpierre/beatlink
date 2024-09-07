<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'user_id' => User::query()->whereEmail('test@test.com')->first()->id,
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
