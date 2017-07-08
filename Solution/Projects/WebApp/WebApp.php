<?php

/**
 * WebApp Project
 */
class WebApp extends Project
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
        RouteRegistration::register($this->_routeContainer);

        $request = $this->_webRequestService->getCurrent();
        $actionResult = $this->_routeContainer->resolve($request);

        if ($actionResult !== null)
        {
            $this->_actionResultService->render($actionResult);
        }
    }
}