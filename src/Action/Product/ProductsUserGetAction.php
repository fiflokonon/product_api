<?php

namespace App\Action\Product;

use App\Domain\Product\Service\ProductsUserGet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductsUserGetAction
{
    private ProductsUserGet $productsUserGet;

    /**
     * @param ProductsUserGet $productsUserGet
     */
    public function __construct(ProductsUserGet $productsUserGet)
    {
        $this->productsUserGet = $productsUserGet;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response,
        array                  $params
    ): ResponseInterface
    {
        //Invoke
        $products = $this->productsUserGet->getUserProducts($params['id']);
        $result = $products;
        //Response
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }
}