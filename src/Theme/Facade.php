<?php

namespace LeadStore\Framework\Theme;

use Illuminate\Support\Facades\Facade as LaraveFacade;

/**
 * @method \LeadStore\Framework\Theme all()
 *
 *
 */
class Facade extends LaraveFacade
{
    protected static function getFacadeAccessor()
    {
        return 'theme';
    }
}
