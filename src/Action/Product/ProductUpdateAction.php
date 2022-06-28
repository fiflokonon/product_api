<?php

namespace App\Action\Product;

use App\Domain\Product\Service\ProductUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ProductUpdateAction
{
    private ProductUpdate $productUpdate;

    /**
     * @param ProductUpdate $productUpdate
     */
    public function __construct(ProductUpdate $productUpdate)
    {
        $this->productUpdate = $productUpdate;
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
        // TODO: Implement __invoke() method.
        //Get Data
        $data = $request->getParsedBody();
        //Invoke
        $product = $this->productUpdate->editProduct($params['id'], $data);
        //Response
        $response->getBody()->write(json_encode($product));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }
}