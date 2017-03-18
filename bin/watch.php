<?php

require_once dirname(__DIR__).'/bootstrap.php';

$xml = file_get_contents(getenv('ATOM_URL'));

$parser = (new \App\RssFeed\ParserFactory())->create('rss2');
$entries = $parser->parse($xml);
$latestEntry = array_shift($entries);

if ($latestEntry->isNotified()) {
    print '最新のエントリーは通知済みでした';
    return;
}

$latestEntry->markAsNotified();

$message = "ブログを書きました。
{$latestEntry->link}";

$notifier = (new \App\UpdateNotify\NotifierFactory())
    ->create('mail', ['destination' => getenv('MAIL_TO')]);
$notifier->notify(
    '',
    $message
);
