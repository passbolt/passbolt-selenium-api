<?php

use Cake\Routing\RouteBuilder;

$routes->scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'index']);
});
