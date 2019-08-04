<?php

use Illuminate\Database\Seeder;

class LibraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $array = ['ERNEST HEMINGWAY' => ['A Sportsmans Sketches', 'Wuthering Heights'],
            'JOAN DIDION' => ['The Paris Review','started a novel'],
            'RAY BRADBURY'=>['Bradbury said','Herman Melville'],
            'David Foster Wallace'=>['A Supposedly Fun...'],
            'HEMINGWAY' => ['Sketches', 'Heights'],
            'DIDION' => ['Review'],
            'BRADBURY'=>['Bradbury'],
            'Foster Wallace'=>['Fun...'],
        ];
        foreach ($array as $key => $item){
            $aut=\Illuminate\Support\Facades\DB::table('authors')->insertGetId(['name'=>$key]);
            foreach ($item as $value){
                $lib=\Illuminate\Support\Facades\DB::table('libraries')->insertGetId(['title'=>$value,'created_at'=>$faker->dateTimeThisMonth()]);
                \Illuminate\Support\Facades\DB::table('library_authors')->insert(['library_id'=>$lib,'author_id'=>$aut]);
            }
        }
    }
}
