<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\Option;
use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
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

        foreach ($options as $option => $features) {
            
            $option = Option::create([
                'name' => $option,
                'type' => $option === 'color' ? 2 : 1
            ]);

            foreach ($features as $feature) {
                $option->features()->create([
                    'value' => $feature
                ]);
            }

        }

    }
}
