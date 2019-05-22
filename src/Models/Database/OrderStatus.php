<?php

namespace LeadStore\Framework\Models\Database;

class OrderStatus extends BaseModel
{
    protected $fillable = ['name', 'is_default'];

    const STATUS_NEW = 1;
    const STATUS_PENDING_PAYMENT = 2;
    const STATUS_PROCESSING = 3;
    const STATUS_SHIPPED = 4;
    const STATUS_DELIVERED = 5;
    const STATUS_CANCELLED = 6;
    const STATUS_RESTORE_STOCK = 7;

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
