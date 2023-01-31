<?php

use App\Router;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/dependencies.php');
$di = null;

try {
    $di = $containerBuilder->build();
} catch (Exception $e) {
    echo $e->getMessage();
}

/** @var Router $router */
$router = $di->get(Router::class);
$router->dispatch();
