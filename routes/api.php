<?php

$routes->group('api', ['namespace' => 'App\Controllers\API\V1'], static function ($routes) {
    //Rotas de login da api
    $routes->post('login', 'JwtauthController::login');
    $routes->post('logout', 'JwtauthController::logout', ['filter' => 'auth:api']);
    $routes->post('refresh', 'JwtauthController::refresh', ['filter' => 'auth:api']);
    $routes->match(['get', 'post'], 'user', 'JwtauthController::user', ['filter' => 'auth:api']);


    //CRUD - Anuncios ///IMPORTANT não podemos usar rotas nomeadas
    $routes->group('adverts', ['namespace' => 'App\Controllers\API\V1', 'filter' => 'subscription:api'], static function ($routes) {

        $routes->get('my', 'AdvertsUserController::index');
        $routes->get('my/(:num)', 'AdvertsUserController::getUserAdvert/$1');
    });
});
