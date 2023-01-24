<?php

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

$conn = [
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'],
];

$entityManager = Doctrine\ORM\EntityManager::create($conn, $config);

$container = new League\Container\Container();
$container->delegate(
    new League\Container\ReflectionContainer(),
);

$container->add(Doctrine\ORM\EntityManager::class, $entityManager);

$templateLoader = new Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new Twig\Environment($templateLoader);

$translationsLoader = new Illuminate\Translation\ArrayLoader();
$translationsLoader->addMessages(
    'en', // Language, should match with translator locale
    'validation', // Default group for validation
    [ // Load messages from array
        'required' => 'The :attribute field is required.',
        'integer' => 'The :attribute must be an integer.',
    ],
);
$validatorFactory = new Illuminate\Validation\Factory(
    new Illuminate\Translation\Translator($translationsLoader, 'en')
);
// Adding entity manager to container
$container->add(Doctrine\ORM\EntityManager::class, $entityManager);
// Add twig to container
$container->add(Twig\Environment::class, $twig);
// Add illuminate validation factory
$container->add(Illuminate\Contracts\Validation\Factory::class, $validatorFactory);

$strategy = (new League\Route\Strategy\ApplicationStrategy())->setContainer($container);
$router = (new League\Route\Router())->setStrategy($strategy);