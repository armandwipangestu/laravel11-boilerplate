<?php

namespace App\Services\Test;

use App\Repositories\Test\Interfaces\TestRepositoryInterface;

class TestService
{
    protected $TestRepository;

    public function __construct(TestRepositoryInterface $TestRepository)
    {
        $this->TestRepository = $TestRepository;
    }

    /**
     * Get all Test records.
     */
    public function getAll()
    {
        return $this->TestRepository->getAll();
    }

    /**
     * Create a new Test.
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->TestRepository->create($data);
    }

    /**
     * Find a Test by ID.
     * 
     * @param int $id
     */
    public function findById(int $id)
    {
        return $this->TestRepository->findById($id);
    }

    /**
     * Update a Test by ID.
     * 
     * @param int $id
     * @param array $data
     */
    public function updateById(int $id, array $data)
    {
        return $this->TestRepository->updateById($id, $data);
    }

    /**
     * Delete a Test by ID.
     * 
     * @param int $id
     */
    public function deleteById(int $id)
    {
        return $this->TestRepository->deleteById($id);
    }
}