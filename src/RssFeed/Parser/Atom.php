<?php

namespace App\RssFeed\Parser;

use App\RssFeed\Entry;
use App\RssFeed\ParserInterface;

class Atom implements ParserInterface
{
    public function parse(string $xml)
    {
        $dom = new \SimpleXMLElement($xml);

        $entries = [];

        foreach ($dom->channel->item as $entry) {
            $entries[] = new Entry([
                'title'       => (string) $entry->title,
                'link'        => (string) $entry->link,
                'publishedAt' => new \DateTime($entry->pubDate),
                'description' => (string) $entry->description,
            ]);
        }

        return $entries;
    }
}
