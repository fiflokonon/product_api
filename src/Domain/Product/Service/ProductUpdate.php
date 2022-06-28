<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Repository\ProductRepository;

final class ProductUpdate
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
     * @param array $data
     * @return array|false|mixed|string
     */
    public function editProduct(int $id, array $data)
    {
        return $this->repository->updateProduct($id, $data);
    }
}