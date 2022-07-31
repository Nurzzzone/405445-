<?php

define('APP_ROOT', dirname(__DIR__));

if (! function_exists('container')) {

    /**
     * Get DI container instance
     *
     * @return Psr\Container\ContainerInterface|null
     */
    function container(): ?Psr\Container\ContainerInterface
    {
        return Slim\Factory\AppFactory::create()->getContainer();
    }
}

if (! function_exists('em')) {

    /**
     * Get Doctrine EntityManager instance
     *
     * @return Doctrine\ORM\EntityManager
     * @throws Psr\Container\ContainerExceptionInterface
     * @throws Psr\Container\NotFoundExceptionInterface
     */
    function em(): Doctrine\ORM\EntityManager
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
