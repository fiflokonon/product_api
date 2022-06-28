<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class UsersGet
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function usersList()
    {
        return $this->repository->getUsers();
    }
}