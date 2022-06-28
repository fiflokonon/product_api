<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

class UserLogin
{
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param array $data
     * @return false|string
     */
    public function connectUser(array $data)
    {
        return $this->repository->login($data);
    }
}