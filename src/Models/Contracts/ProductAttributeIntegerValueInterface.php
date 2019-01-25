<?php

namespace LeadStore\Framework\Models\Contracts;

interface ProductAttributeIntegerValueInterface
{
    /**
     * Create an Attribute
     *
     * @param array $data
     * @return \LeadStore\Framework\Models\Database\ProductAttributeIntegerValue
     */
    public function create($data);
}
