<?php

namespace LeadStore\Framework\User\DataGrid;

use LeadStore\Framework\DataGrid\Facade as DataGrid;

class UserDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->linkColumn('email_verified_at', ['label' => 'Verificado'], function($model) {
                    return $model->email_verified_at ? '<i class="fa fa-check text-success"></i>':  '<i class="fa fa-close text-danger"></i>';
                })
                ->column('document', ['label' => 'Documento'])
                ->column('first_name', ['label' => 'Nome'])
                ->column('last_name', ['label' => 'Sobrenome'])
                ->column('email', ['label' => 'Email'])
                ->linkColumn('edit', ['label' => 'Editar'], function ($model) {
                    return "<a href='" . route('admin.user.edit', $model->id) . "' >Editar</a>";
                })->linkColumn('show', ['label' => 'Visualizar'], function ($model) {
                    return "<a href='" . route('admin.user.show', $model->id) . "' >Visualizar</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
