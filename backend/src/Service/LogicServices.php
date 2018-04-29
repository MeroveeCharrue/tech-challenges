<?php

namespace IWD\JOBINTERVIEW\Service;

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
        $app['get_surveys'] = function () {
            return 'request for surveys';
        };
    }
}