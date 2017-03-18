<?php

namespace App\RssFeed\Parser;

use App\RssFeed\Entry;
use App\RssFeed\ParserInterface;
use App\RssFeed\ParseFailureException;

class Atom implements ParserInterface
{
    public function parse(string $xml)
    {
        $dom = new \SimpleXMLElement($xml);

        $entries = [];

        if (!isset($dom->channel) || !isset($dom->channel->item)) {
            throw new ParseFailureException("[RawXml] `{$xml}`");
        }

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
