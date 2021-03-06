<?php

namespace Glenn\Config;

use ArrayAccess;

use Glenn\Config\Contracts\ManagerContract;

class Manager implements ArrayAccess, ManagerContract
{
    /**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Construct a new Config Manager pre-loaded with items.
     *
     * @param array $items
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Check if a key exists in the config.
     *
     * @param string $key The key in the config to check for existence
     *
     * @return bool
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function has($key)
    {
        $items = $this->all();

        if (empty($items) || is_null($key)) {
            return false;
        }

        if (array_key_exists($key, $items)) {
            return true;
        }

        if ($this->get($key) === null) {
            return false;
        }

        return true;
    }

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
    public function get($key, $default = null)
    {
        $items = $this->all();

        if (array_key_exists($key, $items)) {
            return $items[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !array_key_exists($segment, $items)) {
                return $default;
            }

            $items = $items[$segment];
        }

        return $items;
    }

    /**
     * Retrieve all of the config items.
     *
     * @return array
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Set a config entry by key, optional value.
     *
     * @param string $key   Config key
     * @param mixed  $value Config value
     *
     * @return static return self / $this for chain-ability
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function set($key, $value = null)
    {
        $items = &$this->items;

        $keys = explode('.', $key);

        foreach ($keys as $key) {
            if (!isset($items[$key]) || !is_array($items[$key])) {
                $items[$key] = [];
            }

            $items = &$items[$key];
        }

        $items = $value;

        return $this;
    }

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
    public function setArray($value, $key = null)
    {
        if ($key !== null) {
            $this->set($key, $value);
        } else {
            foreach ($value as $head => $node) {
                $this->set($head, $node);
            }
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Interface - ArrayAccess
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Check if a key exists in the config.
     *
     * @param string $key The key in the config to check for existence
     *
     * @return bool
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * Retrieve a given config value by its key.
     *
     * @param string $key Config key
     *
     * @return mixed The config value
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Set a config entry by key, optional value.
     *
     * @param string $key   Config key
     * @param mixed  $value Config value
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Unset a configuration option.
     *
     * @param string $key
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function offsetUnset($key)
    {
        $this->set($key, null);
    }
}
