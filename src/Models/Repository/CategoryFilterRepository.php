<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Database\CategoryFilter;
use LeadStore\Framework\Models\Contracts\CategoryFilterInterface;

class CategoryFilterRepository implements CategoryFilterInterface
{
    /**
     * Find a Category filter by Id
     *
     * @param integer $id
     * @return \LeadStore\Framework\Models\Database\CategoryFilter
     */
    public function find($id)
    {
        return CategoryFilter::find($id);
    }

    /**
     * Category Filter Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return CategoryFilter::query();
    }

    /**
     * Save Categoy Filter
     * @param integer $categoryId
     * @param integer $filterId
     * @param string $type
     * @return \LeadStore\Framework\Models\Database\CategoryFilter
     */
    public function saveFilter($categoryId, $filterId, $type)
    {
        $filterModel = CategoryFilter::whereCategoryId($categoryId)
                                        ->whereFilterId($filterId)
                                        ->whereType('PROPERTY')->first();
        if (null === $filterModel) {
            CategoryFilter::create([
                'category_id' => $categoryId,
                'filter_id' => $filterId,
                'type' => 'PROPERTY'
            ]);
        }
    }
}
