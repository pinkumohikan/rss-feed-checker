<?php

namespace App\RssFeed;

/**
 * パーサのファクトリ
 */
class ParserFactory
{
    /**
     * 指定したパーサのインスタンスを生成する
     *
     * @param  string $parserName パーサ名 (e.g. Rss2)
     *
     * @return App\RssFeed\ParserInterface ParserInterfaceを実装するパーサ
     * @throws LogicException 存在しないパーサを指定した
     */
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
