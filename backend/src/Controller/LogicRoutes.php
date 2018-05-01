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
         * Surveys list.
         */
        $logic->get('/list', function () use ($app) {
            return $app['survey.api']->getSurveyList();
        });

        /**
         * Answers aggregated by survey code.
         */
        $logic->get('/{code}', function ($code) use ($app) {
            return $app['survey.api']->getAggregationByCode($code);
        });

        return $logic;
    }
}