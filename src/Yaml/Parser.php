<?php

namespace App\Yaml;

use Symfony\Component\Yaml\Yaml;

class Parser
{
    public function parse(string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('File not found. [Path] '.$path);
        }

        return Yaml::parse(file_get_contents($path));
    }
}
