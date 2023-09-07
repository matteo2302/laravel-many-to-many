<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator;
use Illuminate\Support\Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $tecnology_ids = Technology::pluck('id')->toArray();
        $types_ids = Type::pluck('id')->toArray();
        $types_ids[] = null;

        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->name();
            $project->type_id =  Arr::random($types_ids);
            $project->date = $faker->dateTime();
            $project->last_update = $faker->dateTime();
            $project->description = implode(' ', $faker->paragraphs());
            $project->image = $faker->image(null, 640, 480);
            $project->save();
            $project_tecnologies = [];
            foreach ($tecnology_ids as $tecnology_id) {
                if ($faker->boolean()) $project_tecnologies[] = $tecnology_id;
            }


            $project->tecnologies()->attach($project_tecnologies);
        }
    }
}
