<?php

namespace App\Action\User;

use App\Domain\User\Service\UserLogin;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserLoginAction
{
    private UserLogin $userLogin;

    /**
     * @param UserLogin $userLogin
     */
    public function __construct(UserLogin $userLogin)
    {
        $this->userLogin = $userLogin;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        // TODO: Implement __invoke() method.
        // Get Login Infos
        $login = (array)$request->getParsedBody();

        //Invoke
        $loged = $this->userLogin->connectUser($login);

        //Response
        $response->getBody()->write($loged);
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);

    }
}