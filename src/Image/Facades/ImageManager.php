<?php

namespace LeadStore\Framework\Image\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class ImageManager extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'imagemanager';
    }
}
