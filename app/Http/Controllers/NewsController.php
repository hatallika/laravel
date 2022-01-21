<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //вывод списка новостей
    public function index()
    {
        //$news = $this->getNews();
        $model = new News();
        $news = $model->getNews();

        return view('news.index', [
            'newsList' => $news
        ]);
    }

    //конкретная новость
    public function show(int $id)
    {
        $model = new News();
        $news = $model->getNewsById($id);

        return view('news.one', [
            'news' => $news
        ]);
    }
}
