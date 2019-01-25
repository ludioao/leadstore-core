<?php

namespace LeadStore\Framework\Api\Controllers;

use LeadStore\Framework\Models\Database\User;
use LeadStore\Framework\Api\Resources\User\UserCollectionResource;
use LeadStore\Framework\Api\Resources\User\UserResource;

class UserController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $users = User::paginate(10);

        return new UserCollectionResource($users);
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
