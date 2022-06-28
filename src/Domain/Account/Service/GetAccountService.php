<?php

namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;

final class GetAccountService
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
    public function AccountInfo(int $id)
    {
        return $this->repository->getAccount($id);
    }

}