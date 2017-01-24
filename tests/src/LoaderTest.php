<?php

namespace Glenn\Config\Test;

use PHPUnit_Framework_TestCase;

use Glenn\Config\Manager;
use Glenn\Config\Loader;
use Glenn\Config\Parser\JsonParser;

class LoaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can register a parser without a key,
     * and that the key will equal the Parser's class name.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testRegisterParserWithoutKey()
    {
        $loader = new Loader(new Manager);

        $parser = new JsonParser;

        $loader->registerParser($parser);

        $this->assertSame($loader->getParser(JsonParser::class), $parser);
    }

    /**
     * Test that we can register a parser with a key,
     * and that we can resolve that parser out with the given key,
     * and also that we cannot resolve out that parser with it's class name,
     * because that is not the key.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testRegisterParserWithKey()
    {
        $loader = new Loader(new Manager);

        $parser = new JsonParser;

        $key = 'special-parser-name';

        $loader->registerParser($parser, $key);

        $this->assertNull($loader->getParser(JsonParser::class));

        $this->assertSame($loader->getParser($key), $parser);
    }
}
