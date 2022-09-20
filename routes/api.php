<?php

$routes->group('api', ['namespace' => 'App\Controllers\API\V1'], static function ($routes) {
    $routes->post('login', 'JwtauthController::login');
    $routes->post('logout', 'JwtauthController::logout', ['filter' => 'auth:api']);
    $routes->post('refresh', 'JwtauthController::refresh', ['filter' => 'auth:api']);
    $routes->match(['get', 'post'], 'user', 'JwtauthController::user', ['filter' => 'auth:api']);
});
