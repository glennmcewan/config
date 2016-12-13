<?php

namespace Glenn\Config\Contracts;

/**
 * Interface for a Config Parser.
 * Config Parsers are intended to be stateless, so that they can be re-used.
 * We don't need a million different Config Parser objects to exist when booting up the application;
 * we can just re-use a Config Parser. They don't need to maintain state, or keep record of which
 * file they're parsing. After it has parsed the file, or thrown a wobbly, I don't care, I can re-use it :)
 *
 * @author Glenn McEwan <glenn@web-dev.ninja>
 */
interface ParserContract
{
    /**
     * Parse given data from a known source, and convert it in
     * to a PHP array which can be fed in to the config.
     *
     * @param  mixed $data Data, in a known source by the concrete
     * @return array       Data suitable to be fed in to the Config Manager
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function parse($data);
}
