<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Database\Page;
use LeadStore\Framework\Models\Contracts\PageInterface;

class PageRepository implements PageInterface
{
    /**
     * Find a Page by given Id
     *
     * @param $id
     * @return \LeadStore\Framework\Models\Page
     */
    public function find($id)
    {
        return Page::find($id);
    }

    /**
     * Get all Page
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Page::all();
    }

    /**
     * Paginate Page
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Page::paginate($noOfItem);
    }

    /**
     * Get a Page Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Page::query();
    }

    /**
     * Create a Page Query
     *
     * @return \LeadStore\Framework\Models\Menu
     */
    public function create($data)
    {
        return Page::create($data);
    }
}
