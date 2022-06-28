<?php

namespace App\Action\User;

use App\Domain\User\Service\UserUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserUpdateAction
{
    private UserUpdate $userUpdate;

    public function __construct(UserUpdate $userUpdate)
    {
        $this->userUpdate = $userUpdate;
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
        //Get Data
        $data = $request->getParsedBody();
        //Invoke
        $update = $this->userUpdate->updateUser($params['id'], $data);
        $response->getBody()->write(json_encode($update));
        return $response->withHeader('content-Type', 'application/json')->withStatus(200);
    }

}