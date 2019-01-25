<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\RoleInterface;
use LeadStore\Framework\Models\Database\Role;

class RoleRepository implements RoleInterface
{
    /**
     * Find a Role by given Id
     *
     * @param $id
     * @return \LeadStore\Framework\Models\Role
     */
    public function find($id)
    {
        return Role::find($id);
    }

    /**
     * Get all Role
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * Paginate Role
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Role::paginate($noOfItem);
    }

    /**
     * Get a Role Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Role::query();
    }

    /**
     * Create a Role Query
     *
     * @return \LeadStore\Framework\Models\Role
     */
    public function create($data)
    {
        return Role::create($data);
    }
}
