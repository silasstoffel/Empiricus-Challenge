<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/docs', 'AppController@docs');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
