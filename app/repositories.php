<?php
declare(strict_types=1);

use App\Domain\City\City;
use App\Domain\City\CityRepository;
use App\Domain\StickerCode\StickerCode;
use App\Domain\StickerCode\StickerCodeRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        StickerCodeRepository::class => function () {
            return new StickerCodeRepository($em = em(), $em->getClassMetadata(StickerCode::class));
        },
        CityRepository::class => function () {
            return new CityRepository($em = em(), $em->getClassMetadata(City::class));
        }
    ]);
};
