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
        RouteRegistration::register($this->_routeContainer);

        $request = new IFrameworkRequest();
        $actionResult = $this->_routeContainer->resolve($request);

        $this->_actionResultService->render($actionResult);
    }
}