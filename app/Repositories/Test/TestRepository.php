<?php

namespace App\Repositories\Test;

use App\Models\Test;
use App\Repositories\Test\Interfaces\TestRepositoryInterface;

class TestRepository implements TestRepositoryInterface
{
    /**
     * Get all Test records.
     */
    public function getAll()
    {
        return Test::all();
    }

    /**
     * Create a new Test record.
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return Test::create($data);
    }

    /**
     * Find a record Test by ID.
     * 
     * @param int $id
     */
    public function findById(int $id)
    {
        return Test::findOrFail($id);
    }

    /**
     * Update a record Test by ID.
     * 
     * @param int $id
     * @param array $data
     */
    public function updateById(int $id, array $data)
    {
        $model = Test::findOrFail($id);
        $model->update($data);

        return $model;
    }

    /**
     * Delete a record Test by ID.
     * 
     * @param int $id
     */
    public function deleteById(int $id)
    {
        $model = Test::findOrFail($id);
        return $model->delete();
    }
}