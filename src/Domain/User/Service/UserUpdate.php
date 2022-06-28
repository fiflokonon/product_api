<?php

namespace App\Domain\User\Service;


use App\Domain\User\Repository\UserRepository;

final class UserUpdate
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateUser(int $id, array $data)
    {
        return $this->repository->updateUser($id, $data);
    }


}