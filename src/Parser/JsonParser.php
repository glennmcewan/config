<?php

namespace Glenn\Config\Parser;

use Glenn\Config\Contracts\ParserContract;

/**
 * Parses a JSON string in to a format readable by the Config Manager.
 *
 * @author Glenn McEwan <glenn@d3r.com>
 */
class JsonParser implements ParserContract
{
    /**
     * {@inheritdoc}
     *
     * @param string $data JSON as a string
     *
     * @return array Array of data
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function parse($data)
    {
        $array = json_decode($data, true);

        if ($array === null) {
            throw new ParseException('Unable to parse JSON.');
        }

        return $array;
    }
}
