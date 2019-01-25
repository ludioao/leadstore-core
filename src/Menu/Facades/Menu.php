<?php

namespace LeadStore\Framework\Menu\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method \LeadStore\Framework\Menu\Builer make($key, callable  $callable)
 * @method \LeadStore\Framework\Menu\Builer get($key)
 * @method \LeadStore\Framework\Menu\Builer all()
 *
 */class Menu extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
