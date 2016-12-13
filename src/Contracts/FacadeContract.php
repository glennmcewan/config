<?php

namespace Glenn\Config\Contracts;

/**
 * Interface for a Config Facade.
 *
 * A Config Facade is a wrapper around the Config for specific areas,
 * the benefit is that code which relies on pulling values from the config
 * can now run off the Facade's interface, to ensure that if the key values change, the Facade
 * will still return what is expected to be found in the config.
 *
 * A Facade for deployments may have a method like getModulePath() which will look in the config
 * for the entry defining the module directory for a deployment.
 *
 * @author Glenn McEwan <glenn@web-dev.ninja>
 */
interface FacadeContract
{
    /**
     * Get a value from the config.
     * Decorated to pull from the parent if this Facade uses a parent key.
     *
     * @param string $key     The Config key to fetch the value for
     * @param mixed  $default The default, if the config key does not exist.
     *
     * @return mixed The config value, could be a string, array, etc.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function get($key, $default = null);
}
