<?php
declare(strict_types=1);

use App\Application\Actions\City\CityListAction;
use App\Application\Actions\ContestRequest\ContestRequestStoreAction;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Slim\App $app) {
    $app->group('/api/v1', function (Group $group) {
        $group->get('/city/list', CityListAction::class);
        $group->post('/stickerCode/register', ContestRequestStoreAction::class);
    });
};
