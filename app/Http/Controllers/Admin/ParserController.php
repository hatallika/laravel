<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;


use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Models\News;
use App\Models\Source;
use App\ParserSchemes\XmlSchema;
use Illuminate\Http\Request;


class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {

        //удалим старые новости из источников парсинга
        $newsDelete = News::query()->with('source_id');
        if($newsDelete) {
            $newsDelete->delete();
        };

        //парсим в очереди
        $links = Source::query()->where('active', true)->get();

        foreach ($links as $link){
            dispatch(new NewsParsing($link->url, $link->id));
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Новости получены');
       // return "Parsing completed";
    }

}
