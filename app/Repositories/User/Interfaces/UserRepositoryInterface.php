<?php

namespace App\Repositories\User\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Get all User records.
     */
    public function getAll();

    /**
     * Create a new User record.
     * 
     * @param array $data
     */
    public function create(array $data);

    /**
     * Find a record User by ID.
     * 
     * @param int $id
     */
    public function findById(int $id);

    /**
     * Update a record User by ID.
     * 
     * @param int $id
     * @param array $data
     */
    public function updateById(int $id, array $data);

    /**
     * Delete a record User by ID.
     * 
     * @param int $id
     */
    public function deleteById(int $id);
}