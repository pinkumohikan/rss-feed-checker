<?php

namespace App\RssFeed;

/**
 * パーサのインタフェース
 */
interface ParserInterface
{
    /**
     * XMLをパースする
     *
     * @param  string $xml RSSフィードのXML
     *
     * @return App\RssFeed\Entry[] 記事の配列
     */
    public function parse(string $xml);
}
