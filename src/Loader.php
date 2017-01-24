<?php

namespace Glenn\Config;

use Glenn\Config\Contracts\ManagerContract;
use Glenn\Config\Contracts\LoaderContract;
use Glenn\Config\Contracts\ParserContract;

class Loader implements LoaderContract
{
    /**
     * The Config Manager.
     *
     * @var ManagerContract
     */
    protected $config;

    /**
     * The available config parsers.
     *
     * @var ParserContract[]
     */
    protected $parsers;

    /**
     * Construct a new Config Loader with the Config to load in to
     * being passed as a constructor dependency.
     *
     * @param Manager $config
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function __construct(ManagerContract $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     *
     * @param ParserContract $parser
     * @param string         $key
     *
     * @return ParserContract
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function registerParser(ParserContract $parser, $key = null)
    {
        if ($key === null) {
            $key = get_class($parser);
        }

        $this->parsers[$key] = $parser;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $key Parser Key
     *
     * @return ParserContract
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function getParser($key)
    {
        if (!array_key_exists($key, $this->parsers)) {
            return null;
        }

        return $this->parsers[$key];
    }
}
