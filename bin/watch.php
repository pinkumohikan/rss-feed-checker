<?php

require_once dirname(__DIR__).'/bootstrap.php';

use App\RssFeed\ParserFactory;
use App\UpdateNotify\Notifier\Mail;

$xml = file_get_contents(getenv('ATOM_URL'));

$parser = (new ParserFactory())->create('rss2');
$entries = $parser->parse($xml);
$latestEntry = array_shift($entries);

if ($latestEntry->isNotified()) {
    print '最新のエントリーは通知済みでした';
    return;
}

$latestEntry->markAsNotified();

$message = "ブログを書きました。
{$latestEntry->link}";

// 抽象化層作る
$notifier = new Mail();
$notifier->notify(
    getenv('MAIL_TO'),
    '',
    $message
);
