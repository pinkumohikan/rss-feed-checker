<?php

namespace App\UpdateNotify\Notifier;

use App\UpdateNotify\NotifierInterface;

/**
 * 更新をメールで通知する
 */
class Mail implements NotifierInterface
{
    private $destination;

    /**
     * インスタンスを初期化する
     * この通知機を利用する場合、メールの宛先をコンテキスト `destination` として与えること
     *
     * @param  array $context 通知時に必要となるコンテキスト
     *
     * @return void
     */
    public function __construct(array $context = [])
    {
        if (!isset($context['destination'])) {
            throw new \InvalidArgumentException('Must be specified `destination` as context.');
        }

        $this->destination = $context['destination'];
    }

    /**
     * {@inheritdoc}
     */
    public function notify(string $title, string $body) {
        // TODO: SwiftMailerを使うように書き直したい
        //       何か問題があるわけではなく、面倒くさいからやってないだけ
        $cmd = sprintf(
            "echo %s | mail -s %s %s",
            escapeshellarg($body),
            escapeshellarg($title),
            escapeshellarg($this->destination)
        );

        exec($cmd);

        return true;
    }
}
