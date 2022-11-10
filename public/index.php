<?php
include __DIR__ . '/../app/bootstrap.php';
include __DIR__ . '/../app/routing.php';

echo "Hello World";

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES,
);

$container = new League\Container\Container();
$container->delegate(
    new League\Container\ReflectionContainer(),
);

$strategy = (new League\Route\Strategy\ApplicationStrategy)->setContainer($container);
$router = (new League\Route\Router())->setStrategy($strategy);


$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

