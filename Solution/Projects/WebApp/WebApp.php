<?php

/**
 * Solution
 * @package Solution
 */
class WebApp
{
    /** @var IRouteContainer */
    private $_routeContainer;
    /** @var IOutputBufferService */
    private $_outputBufferService;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * WebApp Constructor
     * @param IRouteContainer $routeContainer
     * @param IOutputBufferService $outputBufferService
     * @param IHeaderService $headerService
     */
    public function __construct(
        IRouteContainer $routeContainer,
        IOutputBufferService $outputBufferService,
        IHeaderService $headerService)
    {
        $this->_routeContainer = $routeContainer;
        $this->_outputBufferService = $outputBufferService;
        $this->_headerService = $headerService;
    }

    /**
     * Run Solution
     */
    public function main()
    {
        // Load Configuration
        WebAppConfiguration::configure();

        $this->registerRoutes();

        $request = new IFrameworkRequest();
        $actionResult = $this->_routeContainer->resolve($request);

        if ($actionResult !== null)
        {
            if ($actionResult instanceof JsonActionResult)
            {
                $this->_headerService->set('Content-Type', 'application/json');
            }

            $this->_outputBufferService->start('FormatHelper::minimizeHtml');
            $actionResult->render();
            $this->_outputBufferService->flushContent();
        }
    }

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