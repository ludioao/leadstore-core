<?php

namespace LeadStore\Framework\DataGrid;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 *
 * @method \LeadStore\Framework\DataGrid\Manager make($name)
 * @method \LeadStore\Framework\DataGrid\Manager setPagination($item = 10)
 * @method \LeadStore\Framework\DataGrid\Manager render($dataGrid)
 *
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'datagrid';
    }
}
