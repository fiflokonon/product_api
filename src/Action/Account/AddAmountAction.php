<?php

namespace App\Action\Account;

use App\Domain\Account\Service\AddAmountService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddAmountAction
{
    /**
     * @var AddAmountService
     */
    private AddAmountService $service;

    /**
     * @param AddAmountService $service
     */
    public function __construct(AddAmountService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        //Get Amount
        $amount = $request->getParsedBody();
        //Invoke
        $result = $this->service->addBalance($args['id'], $amount['amount']);
        //Response
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'json/application')->withStatus(200);
    }
}