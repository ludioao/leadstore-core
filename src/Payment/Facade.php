<?php

namespace LeadStore\Framework\Payment;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'LeadStore\Framework\Payment\Manager';
    }
}
