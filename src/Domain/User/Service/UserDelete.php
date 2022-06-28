<?php

namespace App\Domain\User\Service;


use App\Domain\User\Repository\UserRepository;

final class UserDelete
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteUser(int $id)
    {
        return $this->repository->deleteUser($id);
    }
}