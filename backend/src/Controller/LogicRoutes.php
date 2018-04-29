<?php

namespace IWD\JOBINTERVIEW\Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class LogicRoutes implements ControllerProviderInterface
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
        $logic = $app['controllers_factory'];

        /**
         * Surveys
         */
        $logic->get('/surveys', function () use ($app) {
            return $app->json($app['get_surveys']);
        });

        /**
         * Surveys
         */
        $logic->get('/surveys/{code}', function ($code) use ($app) {
            // TODO exception if survey code doesn't exist.
            return $app->json('request for survey '.$code);
        });

        return $logic;
    }
}