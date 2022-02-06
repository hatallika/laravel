<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //вывод списка новостей
    public function index()
    {
        //$news = $this->getNews();

        $news = News::query()->select(News::$availableFields)->get();


        return view('news.index', [
            'newsList' => $news
        ]);
    }

    //конкретная новость
    public function show(News $news)
    {

        return view('news.show', [
            'news' => $news
        ]);
    }

    //Вывод списка новостей по конкретной категории
    public function show_by_category(string $id_category) {

        $news = News::query()->select(News::$availableFields)->where('category_id', '=', $id_category)->get();
        $category = Category::where('id', $id_category)->value('title');

        return view('news.index', ['newsList' =>  $news, 'category' => $category]); //переиспользовали шаблон вывода всех новостей
    }
}
