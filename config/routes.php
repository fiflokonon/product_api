<?php

use App\Action\Product\ProductCreateAction;
use App\Action\Product\ProductDeleteAction;
use App\Action\Product\ProductGetAction;
use App\Action\Product\ProductsGetAction;
use App\Action\Product\ProductsUserGetAction;
use App\Action\Product\ProductUpdateAction;
use App\Action\User\UserCreateAction;
use App\Action\User\UserDeleteAction;
use App\Action\User\UserGetAction;
use App\Action\User\UserLoginAction;
use App\Action\User\UsersGetAction;
use App\Action\User\UserUpdateAction;
use App\Action\Account\NewAccountAction;
use App\Action\Account\AddAmountAction;
use App\Action\Account\AccountsListAction;
use App\Action\Account\GetAmountAction;
use App\Action\Account\GetAccountAction;
use App\Domain\Middleware\LoginMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', function (
        ServerRequestInterface $request,
        ResponseInterface      $response
    ) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });

    $app->group('/api', function (RouteCollectorProxy $app) {
        $app->get('/products', ProductsGetAction::class);
        $app->get('/product/{id}', ProductGetAction::class);
        $app->post('/product/add', ProductCreateAction::class);
        $app->delete('/product/{id}/delete', ProductDeleteAction::class);
        $app->get('/user/{id}/products', ProductsUserGetAction::class);
        $app->put('/product/{id}/update', ProductUpdateAction::class);

        $app->post('/user/{id}/create-account', NewAccountAction::class);
        $app->put('/account/{id}/add-amount', AddAmountAction::class );
        $app->get('/accounts-list', AccountsListAction::class);
        $app->put('/account/{id}/get-amount', GetAmountAction::class);
        $app->get('/account/{id}/info', GetAccountAction::class);
    })->add(LoginMiddleware::class);

    $app->post('/user/{id}/create-account', NewAccountAction::class);
    $app->put('/account/{id}/add-amount', AddAmountAction::class );
    $app->get('/accounts-list', AccountsListAction::class);
    $app->put('/account/{id}/get-amount', GetAmountAction::class);
    $app->get('/account/{id}/info', GetAccountAction::class);

    $app->post('/login', UserLoginAction::class);
    $app->get('/users', UsersGetAction::class);
    $app->get('/user/{id}', UserGetAction::class);
    $app->put('/user/{id}/update', UserUpdateAction::class);
    $app->delete('/user/{id}/delete', UserDeleteAction::class);
    $app->post('/user/add', UserCreateAction::class);
    /*$app->get('/products', ProductsGetAction::class);
    $app->get('/product/{id}', ProductGetAction::class);
    $app->post('/product/add', ProductCreateAction::class);
    $app->delete('/product/{id}/delete', ProductDeleteAction::class);
    $app->get('/user/{id}/products', ProductsUserGetAction::class);
    $app->put('/product/{id}/update', ProductUpdateAction::class);*/
};