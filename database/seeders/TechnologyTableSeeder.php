<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use App\Functions\Helper;

class TechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['HTML', 'JS', 'Php', 'Laravel', 'Vue', 'Blade', 'Bootstrap'];

        foreach ($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Helper::createSlug($new_technology->name, Technology::class);

            $new_technology->save();
        }
    }
}
