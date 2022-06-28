<?php

namespace App\Action\User;

use App\Domain\User\Service\UserDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserDeleteAction
{
    private UserDelete $userDelete;

    public function __construct(UserDelete $userDelete)
    {
        $this->userDelete = $userDelete;
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
        $delete = $this->userDelete->deleteUser($params['id']);
        $response->getBody()->write(json_encode($delete));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }
}