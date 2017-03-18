<?php

namespace App\UpdateNotify;

interface NotifierInterface
{
    public function __construct(array $context = []);
    public function notify(string $title, string $body);
}
