<?php

namespace App\Action\User;

use App\Domain\User\Service\UsersGet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UsersGetAction
{
    private UsersGet $usersGet;

    public function __construct(UsersGet $usersGet)
    {
        $this->usersGet = $usersGet;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        //Invoke
        $users = $this->usersGet->usersList();

        //Response
        $result = $users;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}

