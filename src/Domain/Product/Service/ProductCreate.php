<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Repository\ProductRepository;
use App\Exception\ValidationException;

final class ProductCreate
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
     * @param array $data
     * @return array
     */
    public function createProduct(array $data): array
    {
        //Input Validaition
        $this->validateProduct($data);

        //Insert Product
        $product = $this->repository->insertProduct($data);
        return $product;
    }

    /**
     * @param array $data
     * @return void
     */
    private function validateProduct(array $data): void
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Input is required';
        }

        if (empty($data['price'])) {
            $errors['price'] = 'Inout is required';
        }

        if (empty($data['user_id'])) {
            $errors['user_id'] = 'Input is required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}