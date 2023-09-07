<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(Generator $faker): void
    {
        $labels = ['HTML', 'Css', 'Js', 'Vue', 'Php', 'Laravel'];
        foreach ($labels as $label) {
            $type = new Technology();
            $type->label = $label;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
