<?php

namespace LeadStore\Framework\Order\DataGrid;

use LeadStore\Framework\DataGrid\Facade as DataGrid;

class OrderDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_order_controller');

        $dataGrid->model($model)
                    ->column('id', ['label' => 'N. Pedido', 'sortable' => true])
                    ->column('shipping_name', ['label' => 'Frete'])
                    ->column('payment_name', ['label' => 'Pagamento'])
                    ->linkColumn('order_status', ['label' => 'Status'], function ($model) {
                        return $model->orderStatus->name;
                    })
                    ->column('created_at', ['label' => 'Criação'])
                    ->column('updated_at', ['label' => 'Atualização'])
                    ->linkColumn('view', [], function ($model) {
                        return "<a href='" . route('admin.order.view', $model->id) . "' >Visualizar</a>";
                    });

        $this->dataGrid = $dataGrid;
    }
}
