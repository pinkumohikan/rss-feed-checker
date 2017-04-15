<?php

namespace App\Yaml;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     */
    public function parser_ファイルがないときに¥InvalidArgumentExceptionが返ってくること()
    {
        $parser = new Parser();
        $parser->parse('Nothing/file/pass.yaml');
    }

    /**
     * @test
     */
    public function parser_yamlが正しくparseされること()
    {
        $parser = new Parser();
        $parseYamlResult = $parser->parse(__DIR__ . '/dammy.yaml');

        $this->assertSame(
            [
                "Mary Smith" => [
                    "age"=> 27,
                    "sex" => "women"
                ],
                "Susan Williams" => [
                    "age" => 41,
                    "sex" => "men",
                    "child" => [
                        "john",
                        "same"
                    ]
                ]
            ],
            $parseYamlResult
        );
    }
}