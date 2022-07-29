<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
    ]);
    $containerBuilder->addDefinitions([
       \Doctrine\ORM\EntityManagerInterface::class => function (ContainerInterface $container) {
            $settings = $container->get(SettingsInterface::class);
            $doctrineSettings = $settings->get('doctrine');

            $config = \Doctrine\ORM\ORMSetup::createAnnotationMetadataConfiguration(
                $doctrineSettings['metadata_dirs'],
                $doctrineSettings['dev_mode'],
            );

           $config->setMetadataDriverImpl(
               new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
                   new \Doctrine\Common\Annotations\AnnotationReader(),
                   $doctrineSettings['metadata_dirs']
               )
           );

           $config->setMetadataCache(
               new \Symfony\Component\Cache\Adapter\FilesystemAdapter('', 0, $doctrineSettings['cache_dir'])
           );

           return \Doctrine\ORM\EntityManager::create($doctrineSettings['connection'], $config);
       }
    ]);
};
