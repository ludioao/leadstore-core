<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\StateInterface;
use LeadStore\Framework\Models\Database\State;

class StateRepository implements StateInterface
{
    /**
     * Find a State by given Id
     *
     * @param $id
     * @return \LeadStore\Framework\Models\State
     */
    public function find($id)
    {
        return State::find($id);
    }

    /**
     * Get all State
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return State::all();
    }

    /**
     * Paginate State
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return State::paginate($noOfItem);
    }

    /**
     * Get a State Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return State::query();
    }

    /**
     * Create a State Record
     *
     * @return \LeadStore\Framework\Models\State
     */
    public function create($data)
    {
        return State::create($data);
    }
}
