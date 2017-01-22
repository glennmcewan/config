<?php

namespace Glenn\Config\Contracts;

interface ManagerContract
{
    /**
     * Check if a key exists in the config.
     *
     * @param string $key The key in the config to check for existence
     *
     * @return bool
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function has($key);

    /**
     * Retrieve a given config value by its key.
     *
     * @param string $key     Config key
     * @param mixed  $default Default value if the key doesn't exist
     *
     * @return mixed The config value
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function get($key, $default = null);

    /**
     * Retrieve all of the config items.
     *
     * @return array
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function all();

    /**
     * Set a config entry by key, optional value.
     *
     * @param string $key   Config key
     * @param mixed  $value Config value
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function set($key, $value = null);

    /**
     * If a parent key is passed, for example, as 'deployment',
     * then the data will be put in to the Config as deployment.*,
     * otherwise it will be placed at the root level in the config.
     *
     * Optionally, a parent key in which the config data will reside.
     *
     * @param mixed  $value The array to set in to the config
     * @param string $key   [optional] A parent config key to set the array in to
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function setArray($value, $key = null);
}
