<?php

namespace LeadStore\Framework\Models\Contracts;

interface OrderHistoryInterface
{
    /**
     * Create an Order History
     *
     * @param array $data
     * @return \LeadStore\Framework\Models\Database\Order History
     */
    public function create($data);
}
