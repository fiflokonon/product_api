<?php

namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;

final class GetAmountService
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
     * @return false|mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function getAmount(int $id, int $amount)
    {
        return $this->repository->subAmount($id, $amount);
    }
}