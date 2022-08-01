<?php
declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'promo_mobil',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'doctrine' => [
                    'dev_mode' => true,
                    'cache_dir' => APP_ROOT . '/var/doctrine',
                    'metadata_dirs' => [
//                      dirname(__DIR__) . '/src/Domain/StickerCode/StickerCode.php',
//                      dirname(__DIR__) . '/src/Domain/City/City.php',
                        dirname(__DIR__) . '/src/Domain',
                    ],
                    'connection' => [
                        'driver' => 'pdo_mysql',
                        'host' => '89.218.12.150',
                        'port' => '3306',
                        'dbname' => 'promo_mobil',
                        'user' => 'root',
                        'password' => '1XGBxTKm2IYHWDMeOKiX',
                    ],
                ]
            ]);
        }
    ]);
};
