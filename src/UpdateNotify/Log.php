<?php

namespace App\UpdateNotify;

/**
 * 更新通知のログ
 */
class Log
{
    const FILE_NAME = 'notify.log';

    private $file;

    public function __construct()
    {
        $path = STORAGE_ROOT.'/'.self::FILE_NAME;
        $this->file = new \SplFileObject($path, 'a+');
    }

    /**
     * 指定したURLについて、更新通知を行ったログがあるか確かめる
     *
     * @param  string $link ログがあるか確かめるURL
     *
     * @return bool   ログがある場合true、そうでなければfalse
     */
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

    /**
     * 更新通知のログを書く
     *
     * @param  string $link 更新通知を行ったURL
     *
     * @return bool   ログを書けた場合true
     * @throw  RuntimeException ログの書き込みに失敗した
     */
    public function write(string $link)
    {
        // file open modeが `a+` なら、書き込み時は常に追記になる
        // see: http://php.net/manual/ja/function.fopen.php
        $result = $this->file->fwrite($link);
        if (!$result) {
            throw new \RuntimeException(
                'File write failure. [Path] '.$this->file->getRealPath()
            );
        }

        return true;
    }
}
