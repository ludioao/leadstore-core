<?php

namespace LeadStore\Framework\ShippingZone;

abstract class ShippingZone
{
    abstract public function process($cartProducts);
}
