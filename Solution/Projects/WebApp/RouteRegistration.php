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

            $routeContainer->register(array('ExceptionDemo'), 'ExceptionDemoController');

            $routeContainer->register(array('CookieDemo'), 'CookieDemoController');
            $routeContainer->register(array('CookieDemo', 'ChangeName'), 'CookieDemoController', 'changeName');
            $routeContainer->register(array('CookieDemo', 'DeleteName'), 'CookieDemoController', 'deleteName');

            $routeContainer->register(array('SessionDemo'), 'SessionDemoController');
            $routeContainer->register(array('SessionDemo', 'ChangeName'), 'SessionDemoController', 'changeName');
            $routeContainer->register(array('SessionDemo', 'DeleteName'), 'SessionDemoController', 'deleteName');

            $routeContainer->register(array('JsonDemo'), 'JsonDemoController');
            $routeContainer->register(array('JsonDemo', 'GetRandomPerson'), 'JsonDemoController', 'getRandomPerson');

            $routeContainer->register(array('TemplatingDemo'), 'TemplatingDemoController');

            $routeContainer->register(array('RouteDemo'), 'RouteDemoController', 'topics');
            $routeContainer->register(array('RouteDemo', '{topicId}'), 'RouteDemoController', 'subTopics');
            $routeContainer->register(array('RouteDemo', '{topicId}-{subtopicId}'), 'RouteDemoController', 'subTopicMessages');
            $routeContainer->register(array('RouteDemo', '{topicId}-{subtopicId}-{messageId}'), 'RouteDemoController', 'subTopicMessages');

            $routeContainer->register(array('StreamDemo'), 'StreamDemoController');
            $routeContainer->register(array('StreamDemo', 'FancyTask'), 'StreamDemoController', 'fancyTask');
            $routeContainer->register(array('StreamDemo', 'SendEmails'), 'StreamDemoController', 'sendEmails');

            CacheHelper::save('WebApp', 'RouteContainer', $routeContainer);
        }
    }
}