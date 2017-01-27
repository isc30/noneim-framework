<?php

/**
 * WebApp Project
 * @package WebApp
 */
class WebApp implements IProject
{
    /** @var IRouteContainer */
    private $_routeContainer;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * WebApp Constructor
     * @param IRouteContainer $routeContainer
     * @param IHeaderService $headerService
     */
    public function __construct(
        IRouteContainer $routeContainer,
        IHeaderService $headerService)
    {
        $this->_routeContainer = $routeContainer;
        $this->_headerService = $headerService;
    }

    /**
     * Run project
     */
    public function main()
    {
        $this->registerRoutes();

        $request = new IFrameworkRequest();
        $actionResult = $this->_routeContainer->resolve($request);

        if ($actionResult !== null)
        {
            if ($actionResult instanceof JsonActionResult)
            {
                $this->_headerService->set('Content-Type', 'application/json');
            }

            OutputBufferHelper::start('FormatHelper::minimizeHtml');
            {
                $actionResult->render();
            }
            OutputBufferHelper::flushAndEnd();
        }
    }

    /**
     * Register web routes
     */
    private function registerRoutes()
    {
        if (!CacheHelper::load('WebApp', 'RouteContainer', $this->_routeContainer))
        {
            $this->_routeContainer->registerDefault('Error404Controller');
            $this->_routeContainer->registerException('ExceptionController');
            $this->_routeContainer->register(array('Index'), 'IndexController');

            $this->_routeContainer->register(array('ExceptionDemo'), 'ExceptionDemoController');

            $this->_routeContainer->register(array('CookieDemo'), 'CookieDemoController');
            $this->_routeContainer->register(array('CookieDemo', 'ChangeName'), 'CookieDemoController', 'changeName');
            $this->_routeContainer->register(array('CookieDemo', 'DeleteName'), 'CookieDemoController', 'deleteName');

            $this->_routeContainer->register(array('SessionDemo'), 'SessionDemoController');
            $this->_routeContainer->register(array('SessionDemo', 'ChangeName'), 'SessionDemoController', 'changeName');
            $this->_routeContainer->register(array('SessionDemo', 'DeleteName'), 'SessionDemoController', 'deleteName');

            $this->_routeContainer->register(array('JsonDemo'), 'JsonDemoController');
            $this->_routeContainer->register(array('JsonDemo', 'GetRandomPerson'), 'JsonDemoController', 'getRandomPerson');

            $this->_routeContainer->register(array('OutputBufferDemo'), 'OutputBufferDemoController');

            $this->_routeContainer->register(array('RouteDemo'), 'RouteDemoController', 'topics');
            $this->_routeContainer->register(array('RouteDemo', '{topicId}'), 'RouteDemoController', 'subTopics');
            $this->_routeContainer->register(array('RouteDemo', '{topicId}-{subtopicId}'), 'RouteDemoController', 'subTopicMessages');
            $this->_routeContainer->register(array('RouteDemo', '{topicId}-{subtopicId}-{messageId}'), 'RouteDemoController', 'subTopicMessages');

            CacheHelper::save('WebApp', 'RouteContainer', $this->_routeContainer);
        }
    }
}