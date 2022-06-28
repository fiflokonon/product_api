<?php

namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;

class DeleteAccountService
{
    /**
     * @var AccountRepository
     */
    private AccountRepository $repository;

    /**
     * @param AccountRepository $repository
     */
    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return false|\Psr\Http\Message\ResponseInterface|string
     */
    public function deleteAccount(int $id)
    {
        return $this->repository->deleteAccount($id);
    }
}