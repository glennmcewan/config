<?php

namespace Glenn\Config\Test\Parser;

use PHPUnit_Framework_TestCase;

use Glenn\Config\Parser\JsonParser;
use Glenn\Config\Parser\ParseException;

class JsonParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test valid json input.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testValidJsonFromFile()
    {
        $parser = new JsonParser;

        $expected = [
            'name' => 'Glenn',
            'age' => 18,
            'languages' => [
                'English',
                'French',
            ],
        ];

        $data = file_get_contents(__DIR__ . '/../../fixtures/parser/valid.json');

        $json = $parser->parse($data);

        $this->assertSame($expected, $json);
    }

    /**
     * Test invalid json due to single quotes enclosing strings.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testInvalidJsonSingleQuotes()
    {
        $this->setExpectedException(ParseException::class);

        $parser = new JsonParser;

        $data = file_get_contents(__DIR__ . '/../../fixtures/parser/invalid_single-quotes.json');

        $parser->parse($data);
    }

    /**
     * Test invalid json due to trailing commas.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testInvalidJsonTrailingComma()
    {
        $this->setExpectedException(ParseException::class);

        $parser = new JsonParser;

        $data = file_get_contents(__DIR__ . '/../../fixtures/parser/invalid_trailing-comma.json');

        $parser->parse($data);
    }
}
