<?php

namespace Glenn\Config\Contracts;

interface LoaderContract
{
    /**
     * Register a Parser on to the Config Loader.
     *
     * @param ParserContract $parser
     * @param string         $key    [optional] Name of the Parser's key, used in @getParser($key)
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function registerParser(ParserContract $parser, $key = null);

    /**
     * Get a Parser by its key. Default key scheme is the Parser's FQCN.
     *
     * @param string $key Parser key.
     *
     * @return ParserContract
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function getParser($key);
}
