<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\SiteCurrencyInterface;
use LeadStore\Framework\Models\Database\SiteCurrency;
use LeadStore\Framework\AdminConfiguration\Contracts\DropdownFieldContract;

class SiteCurrencyRepository implements SiteCurrencyInterface, DropdownFieldContract
{
    /**
     * Find an Site Currency by given Id
     *
     * @param $id
     * @return \LeadStore\Framework\Models\SiteCurrency
     */
    public function find($id)
    {
        return SiteCurrency::find($id);
    }

    /**
     * Find an Site Currency by given code
     *
     * @param string $code
     * @return \LeadStore\Framework\Models\SiteCurrency
     */
    public function findByCode($code)
    {
        return SiteCurrency::whereCode($code)->first();
    }

    /**
     * Find an Site Currency by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return SiteCurrency::all();
    }

    /**
     * Paginate Site Currency
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return SiteCurrency::paginate($noOfItem);
    }

    /**
     * Find an Site Currency Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return SiteCurrency::query();
    }

    /**
     * Find an Site Currency Query
     *
     * @return \LeadStore\Framework\Models\SiteCurrency
     */
    public function create($data)
    {
        return SiteCurrency::create($data);
    }

    public function options()
    {
        return SiteCurrency::all()->pluck('code', 'id');
        ;
    }
}
