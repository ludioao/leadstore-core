<?php

namespace LeadStore\Framework\AdminMenu;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method \LeadStore\Framework\AdminMenu\Builer add($key, $callable)
 * @method \LeadStore\Framework\AdminMenu\Builer get($key)
 * @method \LeadStore\Framework\AdminMenu\Builer getMenuItems()
 *
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'adminmenu';
    }
}
