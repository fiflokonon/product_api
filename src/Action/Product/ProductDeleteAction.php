<?php

namespace App\Action\Product;

use App\Domain\Product\Service\ProductDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ProductDeleteAction
{
    private ProductDelete $productDelete;

    /**
     * @param ProductDelete $productDelete
     */
    public function __construct(ProductDelete $productDelete)
    {
        $this->productDelete = $productDelete;
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
        $delete = $this->productDelete->deleteProduct($params['id']);
        //Response
        $response->getBody()->write($delete);
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);

    }

}