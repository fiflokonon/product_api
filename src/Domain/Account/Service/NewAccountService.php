<?php

namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;

final class NewAccountService
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
     * @return \App\Domain\Account\Repository\TYPE_NAME|bool|\Psr\Http\Message\ResponseInterface|string|void
     */
    public function createAccount(int $id)
    {
        return $this->repository->newAccount($id);
    }
}