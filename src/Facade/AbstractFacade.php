<?php

namespace Glenn\Config\Facade;

use Glenn\Config\Contracts\FacadeContract;
use Glenn\Config\Contracts\ManagerContract;

/**
 * Config Facade to help with retrieving data, from the config, which is pertintent to one specific section.
 *
 * This means we can have interfaced Config Managers to aid with ensuring that we don't rely
 * on the config key names, which will make the code more readable and testable.
 *
 * @author Glenn McEwan <glenn@d3r.com>
 */
abstract class AbstractFacade implements FacadeContract
{
    /**
     * Config manager.
     *
     * @var ManagerContract
     */
    protected $config;

    /**
     * The parent key of this Facade's config entries.
     *
     * @var string
     */
    protected $parentKey = null;

    /**
     * Construct a new Facade and pass in the config.
     *
     * @param ManagerContract $config
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function __construct(ManagerContract $config)
    {
        $this->config = $config;
    }

    /**
     * Get a value from the config.
     * Decorated to pull from the parent if this Facade uses a parent key.
     *
     * @param string $key     The Config key to fetch the value for
     * @param mixed  $default the default, if the config key does not exist
     *
     * @return mixed the config value, could be a string, array, etc
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function get($key, $default = null)
    {
        if ($this->isNested()) {
            $key = $this->parentKey.'.'.$key;
        }

        return $this->config->get($key, $default);
    }

    /**
     * When fetching config entries from this facade,
     * are they nested under one parent / head key?
     *
     * @return bool
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    protected function isNested()
    {
        return $this->parentKey ? true : false;
    }
}
