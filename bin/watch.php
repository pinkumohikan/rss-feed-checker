<?php

require_once dirname(__DIR__).'/bootstrap.php';

$configs = (new App\Yaml\Parser())
    ->parse(APP_ROOT.'/config/general.yaml');

foreach ($configs as $c) {
    watchUpdate($c);
}


function watchUpdate(array $config)
{
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
        print '最新のエントリーは通知済みでした';
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
