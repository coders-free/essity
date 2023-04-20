<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Victor Hernan',
            'last_name' => 'Arana Flores',
            'email' => 'victor@codersfree.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('super-admin');

        //Registrar usuarios de farmacia
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('farmacia');

            \App\Models\Profile::factory()->create([
                'user_id' => $user->id,
            ]);

            //Asignar 3 cooperativas
            $user->cooperatives()->attach([
                1 => ['cooperative_number' => rand(10000, 99999)],
                2 => ['cooperative_number' => rand(10000, 99999)],
                3 => ['cooperative_number' => rand(10000, 99999)],
            ]);
        });

        //Registrar usuarios de ortopedia
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('ortopedia');

            \App\Models\Profile::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
