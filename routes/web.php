<?php


use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InfoController::class, 'index']);



//news routes
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/action/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+') // добавили проверку на числа в id если нет, 404
    ->name('news.show');

Route::get('/categories', [CategoriesController::class, 'index']);

Route::get('/categories/{category}', [CategoriesController::class, 'getNewsByCategories'])
    ->name('news.category');


//Route::get('/hello/{name}',
//    fn(string $name) => "Hello, {$name}");

//Route::get('/', function () {
//    return view('welcome');
//});


