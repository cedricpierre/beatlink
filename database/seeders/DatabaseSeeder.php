<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Link;
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
                                        'service' => '\\App\\Services\\Music\\Spotify',
                                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm100.7 364.9c-4.2 0-6.8-1.3-10.7-3.6-62.4-37.6-135-39.2-206.7-24.5-3.9 1-9 2.6-11.9 2.6-9.7 0-15.8-7.7-15.8-15.8 0-10.3 6.1-15.2 13.6-16.8 81.9-18.1 165.6-16.5 237 26.2 6.1 3.9 9.7 7.4 9.7 16.5s-7.1 15.4-15.2 15.4zm26.9-65.6c-5.2 0-8.7-2.3-12.3-4.2-62.5-37-155.7-51.9-238.6-29.4-4.8 1.3-7.4 2.6-11.9 2.6-10.7 0-19.4-8.7-19.4-19.4s5.2-17.8 15.5-20.7c27.8-7.8 56.2-13.6 97.8-13.6 64.9 0 127.6 16.1 177 45.5 8.1 4.8 11.3 11 11.3 19.7-.1 10.8-8.5 19.5-19.4 19.5zm31-76.2c-5.2 0-8.4-1.3-12.9-3.9-71.2-42.5-198.5-52.7-280.9-29.7-3.6 1-8.1 2.6-12.9 2.6-13.2 0-23.3-10.3-23.3-23.6 0-13.6 8.4-21.3 17.4-23.9 35.2-10.3 74.6-15.2 117.5-15.2 73 0 149.5 15.2 205.4 47.8 7.8 4.5 12.9 10.7 12.9 22.6 0 13.6-11 23.3-23.2 23.3z"/></svg>'
                                    ]);

        Platform::factory()->create([
                                        'name' => 'Deezer',
                                        'slug' => 'deezer',
                                        'service' => '\\App\\Services\\Music\\Deezer',
                                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M451.5 244.7H576V172H451.5zm0-173.9v72.7H576V70.8zm0 275.1H576V273.2H451.5zM0 447.1H124.5V374.4H0zm150.5 0H275V374.4H150.5zm150.5 0H425.5V374.4H301zm150.5 0H576V374.4H451.5zM301 345.9H425.5V273.2H301zm-150.5 0H275V273.2H150.5zm0-101.2H275V172H150.5z"/></svg>'
                                    ]);

        Platform::factory()->create([
                                        'name' => 'Tidal',
                                        'slug' => 'tidal',
                                        'service' => '\\App\\Services\\Music\\Tidal',
                                        'icon' => '<svg viewBox="0 0 256 180" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M128.003612,85.338752 L170.668473,128.009031 L128.003612,170.675698 L85.3351396,128.009031 L128.003612,85.338752 Z M42.6666667,0.00180622583 L85.3351396,42.6702791 L42.6666667,85.3405582 L0,42.6702791 L42.6666667,0.00180622583 Z M213.333333,0.00180622583 L256,42.6702791 L213.333333,85.3405582 L170.666667,42.6702791 L128.003612,85.338752 L85.3351396,42.6684729 L128.003612,-2.84217094e-14 L170.666667,42.6648604 L213.333333,0.00180622583 Z" fill="#0A0B09"></path></svg>'
                                    ]);

        Campaign::factory()->has(Link::factory()->count(3))
                ->times(3)
                ->count(3)
                ->create();

    }
}
