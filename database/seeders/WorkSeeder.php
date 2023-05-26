<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $myWorks =[
            [
                'title'=>'Boolflix',
                'description'=>'Sito copia Netflix',
                'date'=> '2023-04-04',
                // 'image'=>'https://media.gqitalia.it/photos/5f2bcea39dfa417e8f7023f3/1:1/w_2211,h_2211,c_limit/N-icon%20(1).png',
                'git_url'=>'https://github.com/DomenicoLucarelli/vite-boolflix',
                'slug'=> '',

            ],
            [
                'title'=>'Boolzapp',
                'description'=>'Sito copia Whatsapp',
                // 'image'=>'https://png.pngtree.com/element_our/md/20180626/md_5b321c99945a2.jpg',
                'date'=> '2023-03-20',
                'git_url'=>'https://github.com/DomenicoLucarelli/vue-boolzapp',
                'slug'=> '',

            ]
        ];

        

        foreach($myWorks as $myWork){

            

            $work = new Work();

            $work->title = $myWork['title'];
            $work->description = $myWork['description'];
            // $work->image = $myWork['image'];
            $work->date = $myWork['date'];
            $work->git_url = $myWork['git_url'];
            $work->slug = Str::slug($work->title, '-');

            $work->save();

        }
    }
}
