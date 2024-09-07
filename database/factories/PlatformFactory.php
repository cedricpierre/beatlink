<?php

namespace Database\Factories;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlatformFactory extends Factory
{
    protected $model = Platform::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->domainName();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
