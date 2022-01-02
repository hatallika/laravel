<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //Вывод списка категорий новостей
    public function index()
    {

        $this->getNews(); // генерируем пока не реализовали состояния в будущем будем брать из DB
        $categories = $this->categories;
        return view('news.categories', ['categories' => $categories]);
    }

    //Вывод списка новостей по конкретной категории
    public function getNewsByCategories(string $category) {
        if (session()->has('news'))
            $this -> news  = session('news');
        else dd('No news category found in session!');
        $news = [];

        foreach ($this->news as $newsItem) {

            if ($newsItem['category'] == $category) {
                $news[] = $newsItem;
            }
        }

        return view('news.index', ['news' => $news]); //переиспользовали шаблон вывода всех новостей
    }
}
