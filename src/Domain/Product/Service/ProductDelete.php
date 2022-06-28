<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Repository\ProductRepository;

final class ProductDelete
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteProduct(int $id)
    {
        return $this->repository->deleteProduct($id);
    }
}