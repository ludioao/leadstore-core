<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\OrderStatusInterface;
use LeadStore\Framework\Models\Database\OrderStatus;

class OrderStatusRepository implements OrderStatusInterface
{
    /**
     * Find a Order Status by given Id
     *
     * @param $id
     * @return \LeadStore\Framework\Models\OrderStatus
     */
    public function find($id)
    {
        return OrderStatus::find($id);
    }

    /**
     * Get all Order Status
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return OrderStatus::all();
    }

    /**
     * Paginate Order Status
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return OrderStatus::paginate($noOfItem);
    }

    /**
     * Get a Order Status Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return OrderStatus::query();
    }

    /**
     * Create a Order Status Record
     *
     * @return \LeadStore\Framework\Models\OrderStatus
     */
    public function create($data)
    {
        return OrderStatus::create($data);
    }
}
