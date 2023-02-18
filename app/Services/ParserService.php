<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\News;
use App\Services\Contracts\Parser;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ParserService implements Parser
{
    private string $link;

    public function setLink(string $link): self
    {
       $this->link = $link;
       return $this;
    }

    public function saveParseData(): void
    {
        $xml = XmlParser::load($this->link);

        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,guid,description,pubDate]'
            ],
        ]);

        foreach ($data["news"] as $news) {
            News::create([
                'title' => $news['title'],
                'link' => $news['link'],
                'description' => $news['description'],
                'guid' => $news['guid'],
            ]);
        }
    }
}
