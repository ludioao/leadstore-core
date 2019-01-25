<?php

namespace LeadStore\Framework\AdminConfiguration\Contracts;

interface DropdownFieldContract
{
    /**
     * Get/Set Admin Configuration Options.
     * @return string|null $key
     */
    public function options();
}
