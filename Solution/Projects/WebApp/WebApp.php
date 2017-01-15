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
    /** @var ICacheService */
    private $_cacheService;

    /**
     * WebApp Constructor
     * @param IRouteContainer $routeContainer
     * @param IOutputBufferService $outputBufferService
     * @param IHeaderService $headerService
     * @param ICacheService $cacheService
     */
    public function __construct(
        IRouteContainer $routeContainer,
        IOutputBufferService $outputBufferService,
        IHeaderService $headerService,
        ICacheService $cacheService)
    {
        $this->_routeContainer = $routeContainer;
        $this->_outputBufferService = $outputBufferService;
        $this->_headerService = $headerService;
        $this->_cacheService = $cacheService;
    }

    /**
     * Run Solution
     */
    public function main()
    {
        WebAppConfiguration::configure();

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
}