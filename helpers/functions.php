<?php

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

define('APP_ROOT', dirname(__DIR__));

if (! function_exists('base_path')) {

    /**
     * Get project base path
     *
     * @return string
     */
    function app_root(): string
    {
        return dirname(__DIR__);
    }
}

if (! function_exists('container')) {

    /**
     * Get DI container instance
     *
     * @return ContainerInterface|null
     */
    function container(): ?ContainerInterface
    {
        return AppFactory::create()->getContainer();
    }
}

if (! function_exists('em')) {

    /**
     * Get Doctrine EntityManager instance
     *
     * @return EntityManager
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function em(): EntityManager
    {
        return container()->get(Doctrine\ORM\EntityManagerInterface::class);
    }
}

if (! function_exists('serializer')) {
    function serializer(): Symfony\Component\Serializer\Serializer
    {
        return new Symfony\Component\Serializer\Serializer(
            [new Symfony\Component\Serializer\Normalizer\ObjectNormalizer()],
            [new Symfony\Component\Serializer\Encoder\JsonEncoder()]
        );
    }
}
