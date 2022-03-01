<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\Category;
use App\Models\News;
use App\Services\UploadService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image as Image;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = News::query()
            //->whereHas('category', function ($query){ $query->where('id', '>', 2);})
            ->with('category')
            //->select(News::$availableFields)
            ->paginate(5)
            //->get()
        ;

        return view('admin.news.index', [
            'newsList' => $news, 'categories'=> Category::query()->get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //$categories = Category::query()->get();
        $categories = Category::all();

        return view('admin.news.create', [
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {

        $created = News::create($request->validated() + [
                'slug' => \Str::slug($request->input('title'))
            ] + ['sources_id' => '1']
        );

        if($created){
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена');
        }

        return back()->with('error', 'Не удалось добавить запись')
            ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(News $news)
    {

        $categories = Category::query()->get();

        return view('admin.news.edit', [
            'news' => $news, 'categories'=>$categories
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $request, News $news)
    {

        $validated = $request->validated();

        if($request->hasFile('image')) {
            $validated['image'] = app(UploadService::class) -> start($request->file('image'));// будет получена ссылка из сервиса UploadService
        }
        $updated = $news->fill($validated )->save();

        if($updated){
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно обновлена');
        }
        return back()->with('error', 'Не удалось обновить запись')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return Response
     */
    public function destroy(News $news)
    {
        try{
            $news->delete();
            return response()->json('ok');
        }catch (\Exception $e){
            \Log::error("Error delete news item");
        }

    }


}
