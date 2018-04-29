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
         * Usage
         */
        $core->get('/usage/{errCode}', function ($errCode) use ($app) {
            $response = array();
            $response['code'] = $errCode;
            // TODO write usage.
            // TODO use provider for this.
            $response['payload'] = 'Usage: Not like this mate.';
            return $app->json($response, $errCode);
        })
            ->value('errCode', 200);

        return $core;
    }
}