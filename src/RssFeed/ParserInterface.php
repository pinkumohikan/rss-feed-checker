<?php

namespace App\RssFeed;

interface ParserInterface
{
    public function parse(string $xml);
}
