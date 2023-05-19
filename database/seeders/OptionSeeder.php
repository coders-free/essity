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
                /* 's', 'm', 'l', 'xl', 'xxl' */
                [
                    'value' => 's',
                    'description' => 'small'
                ],
                [
                    'value' => 'm',
                    'description' => 'medium'
                ],
                [
                    'value' => 'l',
                    'description' => 'large'
                ],
                [
                    'value' => 'xl',
                    'description' => 'extra large'
                ],
                [
                    'value' => 'xxl',
                    'description' => 'extra extra large'
                ],
            ],
            'color' => [
                [
                    'value' => '#000000',
                    'description' => 'black'
                ],
                [
                    'value' => '#ffffff',
                    'description' => 'white'
                ],
                [
                    'value' => '#ff0000',
                    'description' => 'red'
                ],
                [
                    'value' => '#00ff00',
                    'description' => 'green'
                ],
                [
                    'value' => '#0000ff',
                    'description' => 'blue'
                ],
                [
                    'value' => '#ffff00',
                    'description' => 'yellow'
                ]
            ],

            'sexo' => [
                [
                    'value' => 'hombre',
                    'description' => 'hombre'
                ],
                [
                    'value' => 'mujer',
                    'description' => 'mujer'
                ]
            ],
        ];

        foreach ($options as $option => $features) {
            
            $option = Option::create([
                'name' => $option,
                'type' => $option === 'color' ? 2 : 1
            ]);

            foreach ($features as $feature) {
                $option->features()->create($feature);
            }

        }

    }
}
