<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cooperative;
use App\Models\Webinar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CommunitySeeder::class,
            RoleSeeder::class,
            LineSeeder::class
        ]);

        Cooperative::factory(20)->create();

        Webinar::factory(20)->create();
    }
}
