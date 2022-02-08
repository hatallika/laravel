<?php

declare(strict_types=1);
namespace App\Services;

use App\Contracts\Parser;
use Laravie\Parser\Document as BaseDocument;
use \Orchestra\Parser\Xml\Facade as XmlParser;



class ParserService implements  Parser
{

    protected BaseDocument $load;

    /**
     * @param string $link
     * @return Parser
     */
    public function load(string $link): Parser
    {
        $this->load = XmlParser::load($link);
        return $this;
    }

    /**
     * @return array
     */
    public function start(): array
    {
        return $this->load->parse([
            'title' => [
                'uses'=>'channel.title'
            ],
            'description' =>[
                'uses'=>'channel.description'
            ],
            'link' =>[
                'uses'=>'channel.link'
            ],
            'image'=>[
                'uses'=>'channel.image.url'
            ],
            'news' => [
                'uses'=>'channel.item[title,link,guid,description,pubDate]'
            ],
        ]);
    }
}
