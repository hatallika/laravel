<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    //вывод списка новостей
    public function index()
    {
        $news = $this->getNews();

        return view('news.index', [
            'news' => $news
        ]);
    }

    //конкретная новость
    public function show(int $id)
    {
        $news = $this->getNewsById($id);
        return view('news.show', [
            'news' => $news
        ]);
    }
}
