<?php

namespace LeadStore\Framework\Api\Controllers;

use LeadStore\Framework\Models\Database\Order;
use LeadStore\Framework\Api\Resources\Order\OrderCollectionResource;
use LeadStore\Framework\Api\Resources\Order\OrderResource;

class OrderController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $orders = Order::with(['orderStatus'])->latest()->paginate(10);

        return new OrderCollectionResource($orders);
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        $order = Order::find($id);
        return new OrderResource($order);
    }
}
