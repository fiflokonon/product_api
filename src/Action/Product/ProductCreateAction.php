<?php

namespace App\Action\Product;

use App\Domain\Product\Service\ProductCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductCreateAction
{
    private ProductCreate $productCreate;

    public function __construct(ProductCreate $productCreate)
    {
        $this->productCreate = $productCreate;
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
        //Get Data
        $data = $request->getParsedBody();
        //Invoke
        $product = $this->productCreate->createProduct($data);
        //Response
        $response->getBody()->write(json_encode($product));
        return $response->withHeader('content-Type', 'application/json')->withStatus(201);
    }
}