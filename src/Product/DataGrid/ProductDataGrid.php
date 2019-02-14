<?php

namespace LeadStore\Framework\Product\DataGrid;

use LeadStore\Framework\DataGrid\Facade as DataGrid;

class ProductDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_product_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->linkColumn('is_featured', ['label' => 'Favorito'], function($model) {
                $featuredIcon = $model->is_featured ? 'fa fa-star text-success' : 'fa fa-star-o text-danger';
                return "<a href='" . route('admin.product.changeFeatured', $model->id) . "'><i class='$featuredIcon'></i></a>";
            })
            ->column('sku', ['sortable' => true, 'canFilter' => true])
            ->linkColumn('image', [], function ($model) {
                return "<img src='" . $model->image->smallUrl . "' style='max-height: 50px;' />";
            })->column('name', ['label' => 'Nome', 'sortable' => true, 'canFilter' => true])
            ->linkColumn('edit', [], function ($model) {
                return "<a href='" . route('admin.product.edit', $model->id) . "' >Editar</a>";
            })->linkColumn('show', [], function ($model) {
                return "<a href='" . route('admin.product.show', $model->id) . "' >Visualizar</a>";
            });

        $this->dataGrid = $dataGrid;
    }
}
