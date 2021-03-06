<?php

namespace LeadStore\Framework\Models\Contracts;

interface PageInterface
{
    /**
     * Find an Page by given Id which returns Page
     *
     * @param $id
     * @return \LeadStore\Framework\Models\Page
     */
    public function find($id);

    /**
     * Find an All Menu which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Menu Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Menu Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a Page
     *
     * @param array $data
     * @return \LeadStore\Framework\Models\Page
     */
    public function create($data);
}
