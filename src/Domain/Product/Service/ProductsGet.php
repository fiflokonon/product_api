<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Repository\ProductRepository;

final class ProductsGet
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
     * @return array|false
     */
    public function ProductsList()
    {
        return $this->repository->selectProducts();
    }

}