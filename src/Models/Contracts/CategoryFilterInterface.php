<?php

namespace LeadStore\Framework\Models\Contracts;

interface CategoryFilterInterface
{
    /**
     * Find a Category filter by Id
     *
     * @param integer $id
     * @return \LeadStore\Framework\Models\Database\CategoryFilter
     */
    public function find($id);

    /**
     * Category Filter Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Save Categoy Filter
     * @param integer $categoryId
     * @param integer $filterId
     * @param string $type
     * @return \LeadStore\Framework\Models\Database\CategoryFilter
     */
    public function saveFilter($categoryId, $filterId, $type);
}
