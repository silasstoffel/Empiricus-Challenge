<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group(
    ['prefix' => '/users'],
    function () use ($router) {
        $router->get('/', function() {
            return 'index';
        });
    }
);
