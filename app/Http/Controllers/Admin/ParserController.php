<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;


use App\Contracts\Parser;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Parser $service)
    {
        //удалим старые новости из источников парсинга
        $newsDelete = News::query()
            ->where('sources_id' ,2)
            ->orWhere('sources_id' ,3);


        if($newsDelete) {
            $newsDelete->delete();
        };

        //Yandex
        $parserYaNews = $service->load('https://news.yandex.ru/movies.rss')
        ->start('yandex');


        foreach ($parserYaNews['news'] as $news){

                $created =  News::create([
                        'category_id' => 2,
                        'sources_id' => 2,
                        'title' => $news['title'],
                        'description'=>$news['description'],
                        'author' => $parserYaNews['title']
                    ] +
                    ['slug' => \Str::slug($news['title'])]
                );
                if(!$created){
                    return redirect()->route('admin.news.index')
                        ->with('error', 'Парсинг не удался');
                }
        }
        //Mail
        $parserMailNews = $service->load('https://news.mail.ru/rss/sport/')
            ->start('mail');
        //dd($parserMailNews);

        foreach ($parserMailNews['news'] as $news){

            $created =  News::create([
                    'category_id' => 1,
                    'sources_id' => 3,
                    'title' => $news['title'],
                    'description'=>$news['description'],
                    'author' => $parserMailNews['title']
                ] +
                ['slug' => \Str::slug($news['title'])]
            );
            if(!$created){
                return redirect()->route('admin.news.index')
                    ->with('error', 'Парсинг не удался');
            }
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Новости получены');

    }


}
