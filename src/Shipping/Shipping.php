<?php

namespace LeadStore\Framework\Shipping;

use LeadStore\Framework\Shipping\Traits\ShippingUtils;

abstract class Shipping
{
    use ShippingUtils;
    abstract public function process($cartProducts);


    /**
     * @var bool
     */
    protected $rendered = false;

    /**
     * @return bool
     */
    public function isRendered(): bool
    {
        return $this->rendered;
    }

    /**
     * @param bool $rendered
     *
     * @return $this
     */
    public function setRendered(bool $rendered = true)
    {
        $this->rendered = $rendered;
        return $this;
    }

}
