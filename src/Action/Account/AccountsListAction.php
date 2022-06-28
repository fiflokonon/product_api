<?php

namespace App\Action\Account;

use App\Domain\Account\Service\GetAccountsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function DI\string;

final class AccountsListAction
{
    /**
     * @var GetAccountsService
     */
    private GetAccountsService $service;

    /**
     * @param GetAccountsService $service
     */
    public function __construct(GetAccountsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        //Invoke
        $result = $this->service->accountsList();
        //Response
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'json/application')->withStatus(200);
    }
}