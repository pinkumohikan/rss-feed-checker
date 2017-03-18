<?php

namespace App\UpdateNotify;

/**
 * 通知機のファクトリ
 */
class NotifierFactory
{
    /**
     * 指定した通知機のインスタンスを生成する
     *
     * @param  string $notifierName 通知機の名前 (e.g. Mail)
     * @param  array  $context      通知時に必要となるコンテキスト
     *
     * @return App\UpdateNotify\NotifierInterface NotifierInterfaceを実装する通知機
     * @throws LogicException 存在しない通知機を指定した
     */
    public function create(string $notifierName, array $context = [])
    {
        $notifierName = ucfirst(strtolower($notifierName));

        $fqcn = '\\App\\UpdateNotify\\Notifier\\'.$notifierName;

        if (!class_exists($fqcn)) {
            throw new \LogicException("Specified notifier `{$notifierName}` is not supported. [FQCN] {$fqcn}");
        }

        return new $fqcn($context);
    }
}
