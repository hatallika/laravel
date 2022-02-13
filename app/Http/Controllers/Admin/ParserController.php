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
        $links=[
            'https://news.yandex.ru/auto.rss',
            'https://news.yandex.ru/auto_racing.rss',
            'https://news.yandex.ru/army.rss',
            'https://news.yandex.ru/gadgets.rss',
            'https://news.yandex.ru/index.rss',
            'https://news.yandex.ru/martial_arts.rss',
            'https://news.yandex.ru/communal.rss',
            'https://news.yandex.ru/health.rss',
            'https://news.yandex.ru/games.rss',
            'https://news.yandex.ru/internet.rss',
            'https://news.yandex.ru/cyber_sport.rss',
            'https://news.yandex.ru/movies.rss',
            'https://news.yandex.ru/cosmos.rss',
            'https://news.yandex.ru/culture.rss',
            'https://news.yandex.ru/fire.rss',
            'https://news.yandex.ru/championsleague.rss',
            'https://news.yandex.ru/music.rss',
            'https://news.yandex.ru/nhl.rss',
        ];



        //удалим старые новости из источников парсинга
        $newsDelete = News::query()
            ->where('sources_id' ,2)
            ->orWhere('sources_id' ,3);

        if($newsDelete) {
            $newsDelete->delete();
        };

        //парсим в очереди
        foreach ($links as $link){
           // NewsParsing::dispatch($link);
            dispatch(new NewsParsing($link));
        }

        //Mail
        /*$parserMailNews = $service->load('https://news.mail.ru/rss/sport/')
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
        */
        /*return redirect()->route('admin.news.index')
            ->with('success', 'Новости получены');*/
        return "Parsing completed";

    }


}
