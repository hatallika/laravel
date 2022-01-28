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

        //$categories = Category::all();
        $categories = Category::query()->select(Category::$availableFields)->get();
        //dd($categories);
        return view('news.categories', ['categories' => $categories]);
    }


}
