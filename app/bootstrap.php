<?php
// include the Composer autoloader
include __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/..');
$dotenv->load();

$isDevMode = true;
$proxyDir = null;
$cache = null;
$config = Doctrine\ORM\ORMSetup::createAttributeMetadataConfiguration(
    [__DIR__ . '/../src'],
    $isDevMode,
    $proxyDir,
    $cache,
);

// database configuration parameters
$conn = [
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'],
];

// obtaining the entity manager
$entityManager = Doctrine\ORM\EntityManager::create($conn, $config);

$container = new League\Container\Container();
// Adding entity manager to container
$container->add(Doctrine\ORM\EntityManager::class, $entityManager);


$strategy = (new League\Route\Strategy\ApplicationStrategy())->setContainer($container);
$router = (new League\Route\Router())->setStrategy($strategy);