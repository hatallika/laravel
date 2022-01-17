<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //Вывод списка категорий новостей
    public function index()
    {

        $categories = $this->getCategories();
        return view('news.categories', ['categories' => $categories]);
    }

    //Вывод списка новостей по конкретной категории
    public function show(string $idx_category) {

        $news = $this->getNews();
        $categories = $this->getCategories();
        $category = $categories[$idx_category];
        $categoryNews =[];

        foreach ($news as $newsItem) {

            if ($newsItem['category'] == $category) {
                $categoryNews [] = $newsItem;
            }
        }

        return view('news.index', ['news' =>  $categoryNews, 'category' => $category]); //переиспользовали шаблон вывода всех новостей
    }
}
