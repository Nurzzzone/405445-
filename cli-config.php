<?php

/**
 * To run database migrations, validate class annotations and so on you will use the doctrine CLI application
 * In order to work this script needs a cli-config.php file at the root of the project telling it how to find
 * the EntityManager we just set up.
 *
 * Our cli-config.php only needs to retrieve the EntityManager service we just defined in the Slim container
 * and pass it to ConsoleRunner::createHelperSet().
 *
 * @see https://www.slimframework.com/docs/v3/cookbook/database-doctrine.html
 */

require __DIR__ . '/vendor/autoload.php';

$containerBuilder = new DI\ContainerBuilder();

$settings = require __DIR__ . '/app/settings.php';
$settings($containerBuilder);

$dependencies = require __DIR__ . '/app/dependencies.php';
$dependencies($containerBuilder);

$repositories = require __DIR__ . '/app/repositories.php';
$repositories($containerBuilder);

$container = $containerBuilder->build();

Slim\Factory\AppFactory::setContainer($container);
$app = Slim\Factory\AppFactory::create();

$em = $app->getContainer()->get(Doctrine\ORM\EntityManagerInterface::class);

// run php vendor/bin/doctrine command
//return Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);

// run php vendor/bin/doctrine-migrations command
return Doctrine\Migrations\DependencyFactory::fromEntityManager(
    new Doctrine\Migrations\Configuration\Migration\PhpFile(__DIR__ . '/app/migrations.php'),
    new Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager($em)
);
