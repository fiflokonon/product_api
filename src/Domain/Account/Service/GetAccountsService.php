<?php

namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;

final class GetAccountsService
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
     * @return array|false|\Psr\Http\Message\ResponseInterface
     */
    public function accountsList(): array
    {
        return $this->repository->getAccounts();
    }
}