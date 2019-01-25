<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\OrderReturnRequestInterface;
use LeadStore\Framework\Models\Database\OrderReturnRequest;

class OrderReturnRequestRepository implements OrderReturnRequestInterface
{
    /**
     * Find an Order Return Request by a given id of a Order
     *
     * @param integer $id
     * @return \LeadStore\Framework\Models\Database\OrderReturnRequest
     */
    public function find($id)
    {
        return OrderReturnRequest::find($id);
    }

    /**
     * Get an Order Return Request Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        return OrderReturnRequest::query();
    }

    /**
     * Create an Order Return Request
     *
     * @return \LeadStore\Framework\Models\Database\OrderReturnRequest
     */
    public function create($data)
    {
        return OrderReturnRequest::create($data);
    }

    /**
     * Get an Order Return Request Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return OrderReturnRequest::all();
    }
}
