<?php
declare(strict_types=1);

return function (DI\ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        App\Domain\StickerCode\StickerCodeRepository::class => function () {
            return new App\Domain\StickerCode\StickerCodeRepository(
                $em = em(),
                $em->getClassMetadata(App\Domain\StickerCode\StickerCode::class)
            );
        },
        App\Domain\City\CityRepository::class => function () {
            return new App\Domain\City\CityRepository(
                $em = em(),
                $em->getClassMetadata(App\Domain\City\City::class)
            );
        },
        App\Domain\ContestRequest\ContestRequestRepository::class => function () {
            return new App\Domain\ContestRequest\ContestRequestRepository(
                $em = em(),
                $em->getClassMetadata(App\Domain\ContestRequest\ContestRequest::class)
            );
        }
    ]);
};
