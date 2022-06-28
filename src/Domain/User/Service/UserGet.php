<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

class UserGet
{
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUser(int $id)
    {
        return $this->repository->getUser($id);
    }
}