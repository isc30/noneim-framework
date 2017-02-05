<?php

/**
 * Route Registration
 */
class RouteRegistration extends StaticClass
{
    /**
     * @param IRouteContainer $routeContainer
     * @return void
     */
    public static function register(IRouteContainer $routeContainer)
    {
        if (!CacheHelper::load('WebApp', 'RouteContainer', $routeContainer))
        {
            $routeContainer->registerDefault('Error404Controller');
            $routeContainer->registerException('ExceptionController');
            $routeContainer->register(array('Index'), 'IndexController');

            CacheHelper::save('WebApp', 'RouteContainer', $routeContainer);
        }
    }
}