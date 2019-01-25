<?php

namespace LeadStore\Framework\Cart\Contracts;

interface Cart
{
    /**
     * Get/Set Cart Product Name.
     * @return string|\LeadStore\Framework\Cart\Product
     */
    public function name();

    /**
     * Get/Set Cart Product Qty.
     * @return string|\LeadStore\Framework\Cart\Product
     */
    public function qty();

    /**
     * Get/Set Cart Product Price.
     * @return string|\LeadStore\Framework\Cart\Product
     */
    public function price();
}
