<?php

namespace App\Action\Account;

use App\Domain\Account\Service\NewAccountService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class NewAccountAction
{
    /**
     * @var NewAccountService
     */
    private NewAccountService $service;

    /**
     * @param NewAccountService $service
     */
    public function __construct(NewAccountService $service)
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
    ) :ResponseInterface
    {
        //Invoke
        $result = $this->service->createAccount($args['id']);
        //Response
        $response->getBody()->write($result);
        return $response->withHeader('content-Type', 'json/application')->withStatus(201);
    }
}