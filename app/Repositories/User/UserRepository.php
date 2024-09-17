<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get all User records.
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * Create a new User record.
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * Find a record User by ID.
     * 
     * @param int $id
     */
    public function findById(int $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update a record User by ID.
     * 
     * @param int $id
     * @param array $data
     */
    public function updateById(int $id, array $data)
    {
        $model = User::findOrFail($id);
        $model->update($data);

        return $model;
    }

    /**
     * Delete a record User by ID.
     * 
     * @param int $id
     */
    public function deleteById(int $id)
    {
        $model = User::findOrFail($id);
        return $model->delete();
    }
}