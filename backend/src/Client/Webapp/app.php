<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';
require_once ROOT_PATH.'/config/config.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

$app = new Application();

// Configs
$app['debug'] = $config['debug'] ?? false;
$app['data_location'] = $config['data_location'];

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});

// Routes
$app->mount('/', new \IWD\JOBINTERVIEW\Controller\CoreRoutes());

$app->run();

return $app;
