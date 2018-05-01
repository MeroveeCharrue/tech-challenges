<?php

namespace IWD\JOBINTERVIEW\Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class CoreRoutes implements ControllerProviderInterface
{

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $core = $app['controllers_factory'];

        /**
         * Root
         */
        $core->get('/', function () use ($app) {
            $subRequest = Request::create('/usage', 'GET');
            return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        });

        /**
         * Error handler
         */
        $app->error(function (\Exception $e, Request $request, $code) use ($app) {
            // If debug mode, keep nice error
            if ($app['debug']) {
                return;
            }

            return $app['app.usage']($code, $e->getMessage());
        });

        /**
         * Usage
         */
        $core->get('/usage/{code}', function ($code) use ($app) {
            return $app['app.usage']($code);
        })
            ->value('code', 200);

        return $core;
    }
}