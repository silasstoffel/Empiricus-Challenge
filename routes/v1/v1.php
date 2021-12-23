<?php

use Laravel\Lumen\Routing\Router;

$v1 = [
    'prefix' => '/v1',
    'middleware' => [],
];

$routes = [
    '/routes/v1/users.php'
];

$dir = dirname(__DIR__, 2);
/** @var Router $router */
$router->group($v1, function () use ($router, $routes, $dir) {
    foreach ($routes as $route) {
        require $dir . $route;
    }
});
