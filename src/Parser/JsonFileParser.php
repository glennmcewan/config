<?php

namespace Glenn\Config\Parser;

/**
 * Loads up a given file from a path, and passes the data to the parent JsonParser,
 * which will read the contents as a JSON string
 *
 * @author Glenn McEwan <glenn@d3r.com>
 */
class JsonFileParser extends JsonParser
{
    /**
     * Override the parent, because we can parse from a given file's path,
     * rather than the file's string contents.
     *
     * @param  string $data Path to the JSON file to parse
     * @throws Bob\Filesystem\FileNotFoundException
     * @return array       Parent's return value
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function parse($data)
    {
        if (!is_file($data)) {
            throw new ParseException('Unable to load file.');
        }

        $data = file_get_contents($data);

        return parent::parse($data);
    }
}
