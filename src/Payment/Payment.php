<?php

namespace LeadStore\Framework\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts, $request);
}
