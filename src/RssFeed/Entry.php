<?php

namespace App\RssFeed;

use App\UpdateNotify\Log as NotifyLog;

/**
 * 一つの記事を示すエンティティ
 */
class Entry
{
    private $notifyLog;

    private $title;
    private $link;
    private $publishedAt;
    private $description;

    public function __construct(array $properties)
    {
        $this->notifyLog = new NotifyLog();

        foreach ($properties as $k => $v) {
            if (!property_exists($this, $k)) {
                throw new \InvalidArgumentException("Unexpected property. [Property] {$k}");
            }

            $this->$k = $v;
        }
    }

    public function __get($key)
    {
        if (!property_exists($this, $key)) {
            throw new \InvalidArgumentException("Unexpected property. [Property] {$key}");
        }

        return $this->$key;
    }

    /**
     * 更新通知済みか判定する
     *
     * @return bool 更新通知済みならtrue、そうでなければfalse
     */
    public function isNotified()
    {
        return $this->notifyLog->exists($this->link);
    }

    /**
     * 更新通知済みと記録する
     *
     * @return bool 記録に成功すればtrue
     */
    public function markAsNotified()
    {
        return $this->notifyLog->write($this->link);
    }
}
