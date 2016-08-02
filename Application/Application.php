<?php

/**
 * Application
 * @package Application
 */
class Application {

    /** @var IRouteContainer */
    private $_routeContainer;
    /** @var IOutputBufferService */
    private $_outputBufferService;
    /** @var INavigationService */
    private $_navigationService;
    /** @var IHeaderService */
    private $_headerService;

    /** @var ILogService */
    private $_logService;
    /** @var ITimeService */
    private $_timeService;

    /**
     * Application Constructor
     * @param IRouteContainer $routeContainer
     * @param IOutputBufferService $outputBufferService
     * @param INavigationService $navigationService
     *
     * @param IHeaderService $headerService
     * @param ILogService $logService
     * @param ITimeService $timeService
     */
    public function __construct(
        IRouteContainer $routeContainer,
        IOutputBufferService $outputBufferService,
        INavigationService $navigationService,
        IHeaderService $headerService,

        ILogService $logService,
        ITimeService $timeService
    ) {
        $this->_routeContainer = $routeContainer;
        $this->_outputBufferService = $outputBufferService;
        $this->_navigationService = $navigationService;
        $this->_headerService = $headerService;

        $this->_logService = $logService;
        $this->_timeService = $timeService;
    }
    
    /**
     * Run Application
     */
    public function run() {
        
        $startTime = $this->_timeService->microtime(); // For debuging purposes
        
        $request = $this->_navigationService->getSectionRequestArray();
        $actionResult = $this->_routeContainer->resolve($request);

        if ($actionResult !== null) {

            $this->_outputBufferService->start('FormatHelper::minimizeHtml');
            $actionResult->render();

            switch (true) {

                case $actionResult instanceof JsonActionResult: {

                    $this->_headerService->set('Content-Type', 'application/json');
                    break;

                }

                case $actionResult instanceof ViewActionResult || $actionResult instanceof StringActionResult: {
            
                    if (Configuration::debug && ValidationHelper::isHtml($this->_outputBufferService->getContent())) {

                        $this->_logService->log('Core loaded in: ' . IFramework::$coreLoadTime . 'ms');
                        $this->_logService->log('Page loaded in: ' . round(($this->_timeService->microtime() - $startTime) * 1000, 2) . 'ms');
                        $this->_logService->flush();

                    }

                    break;

                }

            }

            $this->_outputBufferService->flushContent();

        }

    }

}