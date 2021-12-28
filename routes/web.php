<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->get('/', 'AppController@docs');

$router->get('/docs', 'AppController@docs');
