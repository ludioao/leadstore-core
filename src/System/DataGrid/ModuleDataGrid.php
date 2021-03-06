<?php

namespace LeadStore\Framework\System\DataGrid;

use LeadStore\Framework\DataGrid\Facade as DataGrid;

class ModuleDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_theme_controller');

        $dataGrid->model($model)
                ->column('name', ['label' => 'Name'])
                ->column('identifier', ['label' => 'Identifier'])
                ->column('status', ['label' => 'Status']);

        $this->dataGrid = $dataGrid;
    }
}
