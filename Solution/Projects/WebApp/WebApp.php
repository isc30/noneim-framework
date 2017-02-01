<?php

/**
 * WebApp Project
 */
class WebApp implements IProject
{
    /** @var IRouteContainer */
    private $_routeContainer;
    /** @var IActionResultService */
    private $_actionResultService;
    /** @var IWebRequestService */
    private $_webRequestService;

    /**
     * WebApp Constructor
     * @param IWebRequestService $webRequestService
     * @param IRouteContainer $routeContainer
     * @param IActionResultService $actionResultService
     */
    public function __construct(
        IWebRequestService $webRequestService,
        IRouteContainer $routeContainer,
        IActionResultService $actionResultService)
    {
        $this->_routeContainer = $routeContainer;
        $this->_actionResultService = $actionResultService;
        $this->_webRequestService = $webRequestService;
    }

    /**
     * Run project
     */
    public function main()
    {
        $this->registerRoutes();

        $request = $this->_webRequestService->getCurrent();
        $actionResult = $this->_routeContainer->resolve($request);

        $this->_actionResultService->render($actionResult);
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

            CacheHelper::save('WebApp', 'RouteContainer', $this->_routeContainer);
        }
    }
}