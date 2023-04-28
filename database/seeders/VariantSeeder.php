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
            'talla' => [
                's', 'm', 'l', 'xl', 'xxl'
            ],
            'color' => [
                "#000000", '#ffffff', '#ff0000', '#00ff00', '#0000ff', '#ffff00', '#00ffff', '#ff00ff', '#c0c0c0', '#808080', '#800000', '#808000', '#008000', '#800080', '#008080', '#000080'
            ],
            'tamaño cadera' => [
                'pequeño', 'mediano', 'grande', 'extra grande'
            ],
            'reembolsos/otc' => [
                'reembolsos', 'otc'
            ],
            'medidas' => [
                'pequeño', 'mediano', 'grande', 'extra grande'
            ],
            'sexo' => [
                'hombre', 'mujer'
            ],
            'otc/rx' => [
                'otc', 'rx'
            ],
        ];

        foreach ($variants as $variant => $features) {
            
            $variant = Variant::create([
                'name' => $variant
            ]);

            foreach ($features as $feature) {
                $variant->features()->create([
                    'name' => $feature
                ]);
            }

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
