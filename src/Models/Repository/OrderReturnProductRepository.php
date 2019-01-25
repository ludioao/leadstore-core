<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\OrderReturnProductInterface;
use LeadStore\Framework\Models\Database\OrderReturnProduct;

class OrderReturnProductRepository implements OrderReturnProductInterface
{
    /**
     * Find an Order Return Product by a given id of a Order
     *
     * @param integer $id
     * @return \LeadStore\Framework\Models\Database\OrderReturnProduct
     */
    public function find($id)
    {
        return OrderReturnProduct::find($id);
    }

    /**
     * Create an Order Return Product by a given id of a Order
     *
     * @param array $id
     * @return \LeadStore\Framework\Models\Database\OrderReturnProduct
     */
    public function create($data)
    {
        return OrderReturnProduct::create($data);
    }

    /**
     * Get an Order Return Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        return OrderReturnProduct::query();
    }

    /**
     * Get an Order Return Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return OrderReturnProduct::all();
    }
}
