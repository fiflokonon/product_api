<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Repository\ProductRepository;

final class ProductsUserGet
{
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
    public function getUserProducts(int $id)
    {
        return $this->repository->selectProductsByUser($id);
    }

}