<?php

namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;

final class AddAmountService
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
     * @param int $amount
     * @return false|\Psr\Http\Message\ResponseInterface|string
     */
    public function  addBalance(int $id, int $amount)
    {
        return $this->repository->addAmount($id, $amount);
    }
}