<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lines = [
            'tena',
            'leukoplast',
            'actimove',
            'jobst',
        ];

        foreach ($lines as $line) {
            Line::create(['name' => $line]);
        }

        Category::factory(20)->create();
        Product::factory(300)->create();
    
    }
}
