<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->scope('/', function (RouteBuilder $routes) {
    $routes->fallbacks(DashedRoute::class);
});