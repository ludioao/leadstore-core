<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Database\OrderHistory;
use LeadStore\Framework\Models\Contracts\OrderHistoryInterface;

class OrderHistoryRepository implements OrderHistoryInterface
{
    /**
     * Create an Order History Record
     *
     * @return \LeadStore\Framework\Models\Database\OrderHistory
     */
    public function create($data)
    {
        return OrderHistory::create($data);
    }
}
