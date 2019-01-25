<?php

namespace LeadStore\Framework\Events;

use Illuminate\Queue\SerializesModels;
use LeadStore\Framework\Models\Database\Product;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ProductAfterSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Product Model Object
     *
     * @var \LeadStore\Framework\Models\Database\Product|Product $product
     */
    public $product = null;

    /**
     * Product Edit Page Form Fields Data
     *
     * @var array $data
     */
    public $data = [];

    /**
     * Create a new event instance.
     *
     * @param \LeadStore\Framework\Models\Database\Product $product
     * @param array $data
     * @return void
     */
    public function __construct(Product $product, array $data)
    {
        $this->product = $product;
        $this->data = $data;
    }
}
