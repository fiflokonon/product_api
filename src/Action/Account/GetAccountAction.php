<?php

namespace App\Action\Account;

use App\Domain\Account\Service\GetAccountService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetAccountAction
{
    /**
     * @var GetAccountService
     */
    private GetAccountService $service;

    /**
     * @param GetAccountService $service
     */
    public function __construct(GetAccountService $service)
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
        // TODO: Implement __invoke() method.
        //Invoke
        $result = $this->service->AccountInfo($args['id']);
        //Response
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'json/application')->withStatus(200);
    }
}