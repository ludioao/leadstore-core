<?php

namespace LeadStore\Framework\Tabs;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'LeadStore\Framework\Tabs\TabsMaker';
    }
}
