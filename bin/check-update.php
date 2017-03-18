<?php

/**
 * RSSフィードの更新をチェックして、更新があれば所定の方法で更新通知を行う
 */

require_once dirname(__DIR__).'/bootstrap.php';

$configs = (new App\Yaml\Parser())
    ->parse(APP_ROOT.'/config/general.yaml');

foreach ($configs as $c) {
    checkUpdate($c);
}


/** 
 * 更新をチェックして、更新があれば更新通知を行う
 *
 * @param  array $config 一つのRSSフィードに対する設定
 *
 * @return bool  更新に成功すればtrue
 */
function checkUpdate(array $config)
{
    print '---'.PHP_EOL;
    print "チェック対象:".$config['title'].PHP_EOL;

    $feedUrl = $config['feed']['url'];
    $xml = file_get_contents($feedUrl);
    if ($xml === false) {
        throw new \RuntimeException('RSS feed download failure. [URL] '.$feedUrl);
    }

    $entries = (new \App\RssFeed\ParserFactory())
        ->create($config['feed']['type'])
        ->parse($xml);
    $latestEntry = array_shift($entries);
    if ($latestEntry->isNotified()) {
        print '最新のエントリーは通知済みでした'.PHP_EOL;
        return true;
    }

    $title = $config['notify']['title'];
    $body  = $config['notify']['body'].PHP_EOL;
    $body .= $latestEntry->link;

    $notifier = (new \App\UpdateNotify\NotifierFactory())
        ->create(
            $config['notify']['method'],
            ['destination' => $config['notify']['destination']]
        )->notify($title, $body);

    $latestEntry->markAsNotified();

    print "通知しました [Title] {$latestEntry->title}".PHP_EOL;

    return true;
}
