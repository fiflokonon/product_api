<?php

namespace App\Action\Account;

use App\Domain\Account\Service\DeleteAccountService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAccountAction
{
    /**
     * @var DeleteAccountService
     */
    private DeleteAccountService $service;

    /**
     * @param DeleteAccountService $service
     */
    public function __construct(DeleteAccountService $service)
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
        //Invoke
        $result = $this->service->deleteAccount($args['id']);
        //Response
        $response->getBody()->write($result);
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }
}