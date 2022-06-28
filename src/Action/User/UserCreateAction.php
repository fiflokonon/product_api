<?php

namespace App\Action\User;

use App\Domain\User\Service\UserCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserCreateAction
{
    private UserCreate $userCreate;

    public function __construct(UserCreate $userCreate)
    {
        $this->userCreate = $userCreate;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $user = $this->userCreate->createUser($data);

        // Transform the result into the JSON representation
        $result = $user;

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}