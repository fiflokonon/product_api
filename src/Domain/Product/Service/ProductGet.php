<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Repository\ProductRepository;

final class ProductGet
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $repository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function getProduct(int $id)
    {
        return $this->repository->selectProduct($id);
    }
}