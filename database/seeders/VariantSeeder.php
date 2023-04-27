<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = [
            'talla', 'color', 'tamaño cadera', 'reembolsos/otc', 'medidas', 'sexo', 'otc/rx'
        ];

        foreach ($variants as $variant) {
            
            Variant::create([
                'name' => $variant
            ]);

        }

        Line::where('name', 'tena')
            ->first()
            ->variants()
            ->attach([
                1, 2, 3, 4
            ]);

        Line::where('name', 'leukoplast')
            ->first()
            ->variants()
            ->attach([
                5
            ]);

        Line::where('name', 'actimove')
            ->first()
            ->variants()
            ->attach([
                1, 5
            ]);

        Line::where('name', 'jobst')
            ->first()
            ->variants()
            ->attach([
                1, 6, 7
            ]);
    }
}
