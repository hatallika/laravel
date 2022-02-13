    <?php


    use App\Http\Controllers\Account\IndexController as AccountController;
    use App\Http\Controllers\Account\ProfileController;
    use App\Http\Controllers\Admin\ParserController;
    use App\Http\Controllers\Admin\UploadController;
    use App\Http\Controllers\Admin\UsersController;
    use App\Http\Controllers\Admin\SourcesController;
    use App\Http\Controllers\CategoriesController;
    use App\Http\Controllers\FeedBackController;
    use App\Http\Controllers\InfoController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\SocialController;
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

//laravel-filemanager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
//upload images
    Route::post('editor/image_upload', [UploadController::class, 'upload'])->name('upload');




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

        Route::get('/parser', ParserController::class)
            ->name('parser');
        Route::view('/', 'admin.index', ['someVariable' => 'someText'])
            ->name('index');
        Route::resource('/news',AdminNewsController::class);
        Route::resource('/categories',AdminCategoryController::class);
        Route::resource('/sources',SourcesController::class);
        Route::resource('/users', UsersController::class);

        Route::get('/news/{news}/deleteimg', function (\App\Models\News $news){

            try{
                $news->image=null;
                $news->save();
                return response()->json('ok');
            }catch (\Exception $e){
                \Log::error("Error delete news item");
            }


        });
    });
});



Route::resource('/feedback', FeedBackController::class);
Route::resource('/order', OrderController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//auth vkontakte
Route::group(['middleware'=>'guest', 'prefix'=>'auth', 'as'=>'social.'], function (){

    Route::get('/{network}/redirect', [SocialController::class, 'redirect'])
        ->name('redirect');

    Route::get('/{network}/callback', [SocialController::class, 'callback'])
        ->name('callback');
});





    /*Route::get('/', function () {
        return view('welcome');
    });*/



    //scopeAdmins in UserModel
/*Route::get('/admins', function (){
    $users = \App\Models\User::query()->admins()->get();
    dd($users);
});*/

