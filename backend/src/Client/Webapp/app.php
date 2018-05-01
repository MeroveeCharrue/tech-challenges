<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}

require_once ROOT_PATH.'/vendor/autoload.php';
require_once ROOT_PATH.'/config/config.php';

use Silex\Application;

$app = new Application();

// Configs
$app['debug'] = $config['debug'] ?? false;
$app['config'] = $config;

// Services
$app->register(new \IWD\JOBINTERVIEW\Service\CoreServices());
$app->register(new \IWD\JOBINTERVIEW\Service\LogicServices());

// Routes
$app->mount('/', new \IWD\JOBINTERVIEW\Controller\CoreRoutes());
$app->mount('/survey', new \IWD\JOBINTERVIEW\Controller\LogicRoutes());

$app->run();

return $app;
