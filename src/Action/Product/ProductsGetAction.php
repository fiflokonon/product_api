<?php

namespace App\Action\Product;

use App\Domain\Product\Service\ProductsGet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductsGetAction
{
    private ProductsGet $productsGet;

    /**
     * @param ProductsGet $productsGet
     */
    public function __construct(ProductsGet $productsGet)
    {
        $this->productsGet = $productsGet;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        //Invoke
        $products = $this->productsGet->ProductsList();

        //Response
        $result = $products;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }

}