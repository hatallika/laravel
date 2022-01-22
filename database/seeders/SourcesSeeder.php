<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class SourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sources')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Factory::create();
        $data = [];
        for($i = 0; $i < 10; $i++ ) {
            $data[] = [
                'title' => $faker->sentence(mt_rand(3,5)),
                'url'=> $faker->url(),
                'description'=> $faker->text(mt_rand(100,200))

                /*'description' => function($faker){      //null or  text
                $input = [null, $faker->text(mt_rand(100, 200))];
                $rand_keys = rand(0,1);
                return $input[$rand_keys];
            }*/
            ];
        }
        return $data;
    }
}
