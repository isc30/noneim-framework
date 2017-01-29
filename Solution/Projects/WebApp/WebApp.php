<?php

class WebApp implements IProject
{
    /** @var IRouteContainer */
    private $_routeContainer;
    /** @var IActionResultService */
    private $_actionResultService;

    /**
     * WebApp Constructor
     * @param IRouteContainer $routeContainer
     * @param IActionResultService $actionResultService
     */
    public function __construct(
        IRouteContainer $routeContainer,
        IActionResultService $actionResultService)
    {
        $this->_routeContainer = $routeContainer;
        $this->_actionResultService = $actionResultService;
    }

    /**
     * Run project
     */
    public function main()
    {
        $this->registerRoutes();

        $request = new IFrameworkRequest();
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