<?php

namespace App\Domain\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpException;
use Slim\Psr7\Response;

class LoginMiddleware
{
    private Error $error;
    private ResponseFactoryInterface $responseFactory;

    /**
     * @param ResponseFactoryInterface $responseFactory
     * @param Error $error
     */
    public function __construct(ResponseFactoryInterface $responseFactory, Error $error)
    {
        $this->responseFactory = $responseFactory;
        $this->error = $error;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement __invoke() method...
        if (isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
            try {
                return $handler->handle($request);
            } catch (HttpException $exception) {
                // Handle the http exception here
                $statusCode = $exception->getCode();
                $response = $this->responseFactory->createResponse()->withStatus($statusCode);
                $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
                $response->getBody()->write($errorMessage);
                return $response;
            }
        } else {
            $response = new Response();
            return $this->error->setErrors($response, 401, 'Unauthorized');
        }
    }

}
