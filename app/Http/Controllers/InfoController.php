<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    //вывод страницы приветствия
    public function index()
    {
        return view('about');
    }
}
