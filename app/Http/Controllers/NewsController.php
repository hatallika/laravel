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

    //Вывод списка новостей по конкретной категории
    public function show_by_category(string $id_category) {
        $model = new News();
        $news = $model->getNewsByColumn($column = 'category_id', $id_category);



        $category = (new Category())->getCategoryById($id_category);
        //dd($category);

        return view('news.index', ['newsList' =>  $news, 'category' => $category->title]); //переиспользовали шаблон вывода всех новостей
    }
}
