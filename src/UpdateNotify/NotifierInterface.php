<?php

namespace App\UpdateNotify;

/**
 * 通知機のインタフェース
 */
interface NotifierInterface
{
    /**
     * インスタンスを初期化する
     *
     * @param  array $context 通知時に必要となるコンテキスト
     *
     * @return void
     */
    public function __construct(array $context = []);

    /**
     * 更新を通知する
     *
     * @param  string $title タイトル
     * @param  string $body  メッセージ本文
     *
     * @return bool   通知に成功すればtrue
     */
    public function notify(string $title, string $body);
}
