<?php

namespace App\Services\User;

use App\Repositories\User\Interfaces\UserRepositoryInterface;

class UserService
{
    protected $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * Get all User records.
     */
    public function getAll()
    {
        return $this->UserRepository->getAll();
    }

    /**
     * Create a new User.
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->UserRepository->create($data);
    }

    /**
     * Find a User by ID.
     * 
     * @param int $id
     */
    public function findById(int $id)
    {
        return $this->UserRepository->findById($id);
    }

    /**
     * Update a User by ID.
     * 
     * @param int $id
     * @param array $data
     */
    public function updateById(int $id, array $data)
    {
        return $this->UserRepository->updateById($id, $data);
    }

    /**
     * Delete a User by ID.
     * 
     * @param int $id
     */
    public function deleteById(int $id)
    {
        return $this->UserRepository->deleteById($id);
    }
}