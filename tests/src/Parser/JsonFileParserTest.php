<?php

namespace Glenn\Config\Test\Parser;

use PHPUnit_Framework_TestCase;

use Glenn\Config\Parser\JsonFileParser;
use Glenn\Config\Parser\ParseException;

class JsonFileParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test valid JSON file.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testValidJsonFromFile()
    {
        $parser = new JsonFileParser;

        $path = __DIR__ . '/../../fixtures/parser/valid.json';

        $expected = [
            'name' => 'Glenn',
            'age' => 18,
            'languages' => [
                'English',
                'French',
            ],
        ];

        $json = $parser->parse($path);

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

        $parser = new JsonFileParser;

        $path = __DIR__ . '/../../fixtures/parser/invalid_single-quotes.json';

        $parser->parse($path);
    }

    /**
     * Test invalid json due to trailing commas.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testInvalidJsonTrailingComma()
    {
        $this->setExpectedException(ParseException::class);

        $parser = new JsonFileParser;

        $path = __DIR__ . '/../../fixtures/parser/invalid_trailing-comma.json';

        $parser->parse($path);
    }
}
