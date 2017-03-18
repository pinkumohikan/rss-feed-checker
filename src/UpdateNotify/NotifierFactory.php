<?php

namespace App\UpdateNotify;

class NotifierFactory
{
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
