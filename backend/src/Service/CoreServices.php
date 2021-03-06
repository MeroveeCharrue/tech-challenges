<?php

namespace IWD\JOBINTERVIEW\Service;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreServices implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $app A container instance
     */
    public function register(Container $app)
    {
        // Render exception or basic usage.
        $app['app.usage'] = $app->protect(function ($code, $message = '') use ($app) {
            $usage = array();

            $usage['code'] = $code;
            if ($message) {
                $usage['message'] = $message;
            }
            $usage['usage'] = $app['config']['usage'];

            return $usage;
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     *
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $app->after(function (Request $request, Response $response) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
        });

        $app->view(function (array $controllerResult) use ($app) {
            return $app->json($controllerResult);
        });
    }
}
