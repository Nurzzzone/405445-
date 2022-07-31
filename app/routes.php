<?php
declare(strict_types=1);

use App\Application\Actions\City\CityListAction;
use App\Application\Actions\StickerCode\StickerCodeListAction;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Slim\App $app) {
    $app->group('/api/v1', function (Group $group) {
        $group->get('/sticker-code/list', StickerCodeListAction::class);
        $group->get('/city/list', CityListAction::class);
    });
};
