<?php

namespace LeadStore\Framework\Breadcrumb;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 *
 * @method \LeadStore\Framework\Breadcrumb\Builer make($name, callable  $callable)
 * @method \LeadStore\Framework\Breadcrumb\Builer render($routeName)
 * @method \LeadStore\Framework\Breadcrumb\Builer get($key)
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'breadcrumb';
    }
}
