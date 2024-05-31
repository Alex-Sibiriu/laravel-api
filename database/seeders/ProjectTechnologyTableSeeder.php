<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 70; $i++) {
            $project = Project::inRandomOrder()->first();

            $technology_id = Technology::inRandomOrder()->first()->id;

            if (!$project->technologies()->where('technology_id', $technology_id)->exists()) {
                $project->technologies()->attach($technology_id);
            }
        }
    }
}
