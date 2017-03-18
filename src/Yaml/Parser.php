<?php

namespace App\Yaml;

use Symfony\Component\Yaml\Yaml;

/**
 * YAMLをパースする
 */
class Parser
{
    /**
     * YAMLをパースする
     *
     * @param  string $path YAMLファイルのパス
     *
     * @return array  パース結果の配列
     * @throws InvalidArgumentException 存在しないパスを指定した
     */
    public function parse(string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('File not found. [Path] '.$path);
        }

        // see: https://github.com/symfony/yaml
        return Yaml::parse(file_get_contents($path));
    }
}
