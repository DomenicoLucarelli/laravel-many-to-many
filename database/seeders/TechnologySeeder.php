<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $techArray = ['php', 'js', 'html', 'css', 'scss', ];

        foreach($techArray as $techEl){

            $technology = new Technology();

            $technology->name = $techEl;
            $technology->color = $faker->hexColor();
            $technology->slug = Str::slug($technology->name, '-');
            
            $technology->save();
            
        };
    }
}
