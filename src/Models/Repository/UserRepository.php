<?php

namespace LeadStore\Framework\Models\Repository;

use LeadStore\Framework\Models\Contracts\UserInterface;
use LeadStore\Framework\Models\Database\User;

class UserRepository implements UserInterface
{
    /**
     * Find an User by given Id
     *
     * @param $id
     * @return \LeadStore\Framework\Models\User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Find an User by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Paginate User
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return User::paginate($noOfItem);
    }

    /**
     * Find an User Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query();
    }

    /**
     * Find an User Query
     *
     * @return \LeadStore\Framework\Models\User
     */
    public function create($data)
    {
        return User::create($data);
    }


    public function findByEmail($email)
    {
        return User::where('email', '=', $email)->first();
    }
}
