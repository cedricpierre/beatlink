<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'testtest'
        ]);

        Platform::factory()->create([
                                        'name' => 'Spotify',
                                        'slug' => 'spotify',
                                        'service' => '\\App\\Platform\\Spotify',
                                        'icon' => '/brands/spotify.svg'
                                    ]);

        Platform::factory()->create([
                                        'name' => 'Deezer',
                                        'slug' => 'deezer',
                                        'service' => '\\App\\Platform\\Deezer',
                                        'icon' => '/brands/deezer.svg'
                                    ]);

        Platform::factory()->create([
                                        'name' => 'Tidal',
                                        'slug' => 'tidal',
                                        'service' => '\\App\\Platform\\Tidal',
                                        'icon' => '/brands/tidal.svg'
                                    ]);

        Campaign::factory()
                ->count(30)
                ->create();

    }
}
