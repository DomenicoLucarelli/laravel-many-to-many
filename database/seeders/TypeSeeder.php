<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesArray = ['Front-End', 'Back-End', 'Full-Stack'];

        foreach($typesArray as $el){

            $type = new Type();

            $type->name = $el;
            $type->slug = Str::slug($type->name,'-');

            $type->save();

        }
    }
}
