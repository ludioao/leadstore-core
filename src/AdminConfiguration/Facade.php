<?php

namespace LeadStore\Framework\AdminConfiguration;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method \LeadStore\Framework\AdminConfiguration\Manager all()
 * @method \LeadStore\Framework\AdminConfiguration\Manager add($key)
 * @method \LeadStore\Framework\AdminConfiguration\Manager get($key)
 * @method \LeadStore\Framework\AdminConfiguration\Manager set($key, $configurationCollection)
 */
class Facade extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'adminconfiguration';
    }
}
