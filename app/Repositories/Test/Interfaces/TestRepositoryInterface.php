<?php

namespace App\Repositories\Test\Interfaces;

interface TestRepositoryInterface
{
    /**
     * Get all Test records.
     */
    public function getAll();

    /**
     * Create a new Test record.
     * 
     * @param array $data
     */
    public function create(array $data);

    /**
     * Find a record Test by ID.
     * 
     * @param int $id
     */
    public function findById(int $id);

    /**
     * Update a record Test by ID.
     * 
     * @param int $id
     * @param array $data
     */
    public function updateById(int $id, array $data);

    /**
     * Delete a record Test by ID.
     * 
     * @param int $id
     */
    public function deleteById(int $id);
}