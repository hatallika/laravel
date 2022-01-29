<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //Вывод списка категорий новостей
    public function index()
    {
        $model = new Category();
        $categories = $model->getCategories();
        //dd($categories);
        return view('news.categories', ['categories' => $categories]);
    }


}
