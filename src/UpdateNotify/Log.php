<?php

namespace App\UpdateNotify;

class Log
{
    const FILE_NAME = 'notify.log';

    private $file;

    public function __construct()
    {
        $path = STORAGE_ROOT.'/'.self::FILE_NAME;

        // see: http://php.net/manual/ja/function.fopen.php
        $this->file = new \SplFileObject($path, 'a+');
    }

    public function exists(string $link)
    {
        $link = trim($link);

        $this->file->rewind();

        foreach ($this->file as $line) {
            if (strpos($line, $link) !== false) {
                return true;
            }
        }

        return false;
    }

    public function write(string $link)
    {
        // file open modeが `a+` なら、書き込み時は常に追記になる
        return $this->file->fwrite($link);
    }
}
