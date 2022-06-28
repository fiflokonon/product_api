<?php

namespace App\Action\Account;



use App\Domain\Account\Service\GetAmountService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetAmountAction
{
    private GetAmountService $service;

    /**
     * @param GetAmountService $service
     */
    public function __construct(GetAmountService $service)
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
        $result = $this->service->getAmount($args['id'], $amount['amount']);
        //Response
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'json/application')->withStatus(200);
    }
}