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
            $line = Line::create([
                'name' => $line,
                'image_url' => "lines/{$line}-300x300.png"
            ]);

            Category::factory(4)->create([
                'line_id' => $line->id
            ])->each(function ($category) {
                Product::factory(12)->create([
                    'category_id' => $category->id
                ]);
            });
        }
    
    }
}
