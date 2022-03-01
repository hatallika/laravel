    <?php


    use App\Http\Controllers\Account\IndexController as AccountController;
    use App\Http\Controllers\Account\ProfileController;
    use App\Http\Controllers\Admin\UsersController;
    use App\Http\Controllers\Admin\SourcesController;
    use App\Http\Controllers\CategoriesController;
    use App\Http\Controllers\FeedBackController;
    use App\Http\Controllers\InfoController;
    use App\Http\Controllers\OrderController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\NewsController;
    use App\Http\Controllers\Admin\NewsController as AdminNewsController;
    use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


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

/*Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    $token = csrf_token();
});*/

Route::get('/', [InfoController::class, 'index']);


//news routes
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+') // добавили проверку на числа в id если нет, 404
    ->name('news.show');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');

Route::get('/categories/{id_category}', [NewsController::class, 'show_by_category'])
    ->name('news.category');


//admin routes
Route::group(['middleware' =>'auth'], function (){

     Route::get('/account', AccountController::class)
        ->name('account');

    Route::get('/account/logout', function (){
        \Auth::logout();
        return redirect()->route('login');
    })->name('account.logout');

    //Просмотр своего профиля
    Route::resource('/profile', ProfileController::class);

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        Route::view('/', 'admin.index', ['someVariable' => 'someText'])->name('index');
        Route::resource('/news',AdminNewsController::class);
        Route::resource('/categories',AdminCategoryController::class);
        Route::resource('/sources',SourcesController::class);
        Route::resource('/users', UsersController::class);
    });
});



Route::resource('/feedback', FeedBackController::class);
Route::resource('/order', OrderController::class);

/*Route::get('/', function () {
    return view('welcome');
});*/


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

