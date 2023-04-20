<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeographicAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $geographicAreas = [
          'Zona Centro',
          'Zona Este & Isalas',
          'Zona Norte',
          'Zona Sur'  
        ];

        foreach ($geographicAreas as $geographicArea) {
            \App\Models\GeographicArea::create([
                'name' => $geographicArea,
            ]);
        }
    }
}
