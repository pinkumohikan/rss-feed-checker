<?php

namespace App\UpdateNotify\Notifier;

class Mail
{
    public function notify(
        string $mailTo,
        string $title,
        string $body
    ) {
        // TODO: SwiftMailer使うように書き直す
        $cmd = sprintf(
            "echo '%s | mail -s '%s' %s",
            escapeshellarg($body),
            escapeshellarg($title),
            escapeshellarg($mailTo)
        );

        exec($cmd);

        return true;
    }
}
