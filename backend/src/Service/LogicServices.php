<?php

namespace IWD\JOBINTERVIEW\Service;

use IWD\JOBINTERVIEW\Survey\Model\SurveyMaker;
use IWD\JOBINTERVIEW\Survey\SurveyAPI;
use IWD\JOBINTERVIEW\Survey\SurveyDao;
use IWD\JOBINTERVIEW\Survey\SurveyManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogicServices implements ServiceProviderInterface
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
        $app['survey.maker'] = function () {
            return new SurveyMaker();
        };
        $app['survey.dao'] = function ($app) {
            return new SurveyDao(
                $app['survey.maker'],
                $app['config']['data_location']
            );
        };
        $app['survey.manager'] = function ($app) {
            return new SurveyManager(
                $app['survey.dao'],
                $app['config']['date_format']
            );
        };
        $app['survey.api'] = function ($app) {
            return new SurveyAPI($app['survey.manager']);
        };
    }
}
