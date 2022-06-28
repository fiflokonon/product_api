<?php

namespace App\Action\Product;

use App\Domain\Product\Service\ProductGet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ProductGetAction
{
    private ProductGet $productGet;

    /**
     * @param ProductGet $productGet
     */
    public function __construct(ProductGet $productGet)
    {
        $this->productGet = $productGet;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $params
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response,
        array                  $params
    ): ResponseInterface
    {

        //Invoke
        $product = $this->productGet->getProduct($params['id']);

        //Response
        $result = $product;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }
}