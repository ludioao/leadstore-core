<?php

namespace LeadStore\Framework\Shipping;

use LeadStore\Framework\Shipping\Traits\ShippingUtils;

abstract class Shipping
{
    use ShippingUtils;
    abstract public function process($cartProducts);
}
