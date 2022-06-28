<?php

namespace App\Action\User;

use App\Domain\User\Service\UserGet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserGetAction
{
    private UserGet $userGet;

    public function __construct(UserGet $userGet)
    {
        $this->userGet = $userGet;
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
        $user = $this->userGet->getUser($params['id']);

        //Response
        $result = $user;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }
}