<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cooperative;
use App\Models\Webinar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Cooperative::factory(20)->create();

        Webinar::factory(20)->create();

        $this->call([
            CommunitySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            LineSeeder::class,
            ClusterSeeder::class,
            GeographicAreaSeeder::class,
            OptionSeeder::class,
        ]);
        
    }
}
