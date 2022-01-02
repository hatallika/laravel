<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const numCategory = 5;

    public $news = [];
    public $categories = [];

    public function getNews(): array
    {
        //генерируем новости
        $faker = Factory::create();

        $this->categories  = $this->getCategories(); // получим статичный массив категорий
        for($i=0; $i<10; $i++) {
            $this->news [] = [
                'id' => $i,
                'title' => $faker->jobTitle(),
                'description' => $faker->text(250),
                'author' => $faker->userName(),
                'category' => $this->categories[rand(0, self::numCategory - 1)]
            ];
        }
        session(['news' => $this->news]);
        return $this->news;
    }

    public function getCategories(): array{
        $faker = Factory::create();
        $categories = [];

        for($i=0; $i<self::numCategory; $i++) {
            $categories[] = $faker->word();
        }
        return $categories;
    }


    public function getNewsById (int $id)
    {
        $faker = Factory::create();

        return [
            'id' => $id,
            'title' => $faker->jobTitle(),
            'description' => $faker->text(250),
            'author' => $faker->userName(),
            'category' => $faker->word
        ];
    }
}
