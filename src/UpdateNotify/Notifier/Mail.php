<?php

namespace App\UpdateNotify\Notifier;

use App\UpdateNotify\NotifierInterface;

class Mail implements NotifierInterface
{
    private $destination;

    public function __construct(array $context = [])
    {
        if (!isset($context['destination'])) {
            throw new \InvalidArgumentException('Must be specified `destination` as context.');
        }

        $this->destination = $context['destination'];
    }

    public function notify(string $title, string $body) {
        // TODO: SwiftMailer使うように書き直す
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
