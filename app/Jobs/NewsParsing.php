<?php

namespace App\Jobs;

use App\Contracts\Parser;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class  NewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $link;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Parser $service)
    {
        $service->load($this->link)
            ->start('yandex');


       /* $parserYaNews = $service->load($this->link)
            ->start('yandex');

        foreach ($parserYaNews['news'] as $news){

        //запись в базу
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
                    ->with('error', 'Парсинг  не удался');
            }
        }
*/

    }
}
