<?php

namespace App\RssFeed;

class ParserFactory
{
    public function create(string $parserName)
    {
        $parserName = ucfirst(strtolower($parserName));

        $fqcn = '\\App\\RssFeed\Parser\\'.$parserName;

        if (!class_exists($fqcn)) {
            throw new \LogicException("Specified parser `{$parserName}` is not supported. [FQCN] {$fqcn}");
        }

        return new $fqcn;
    }
}
