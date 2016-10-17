<?php

/**
 * Application
 * @package Application
 */
class Application
{
    private $_classFactory;
    private $_routeContainer;
    private $_outputBufferService;
    private $_headerService;

    /**
     * Application Constructor
     * @param IClassFactory $classFactory
     * @param IRouteContainer $routeContainer
     * @param IOutputBufferService $outputBufferService
     * @param IHeaderService $headerService
     */
    public function __construct(
        IClassFactory $classFactory,
        IRouteContainer $routeContainer,
        IOutputBufferService $outputBufferService,
        IHeaderService $headerService)
    {
        $this->_classFactory = $classFactory;
        $this->_routeContainer = $routeContainer;
        $this->_outputBufferService = $outputBufferService;
        $this->_headerService = $headerService;
    }

    /**
     * Run Application
     */
    public function run()
    {
        $request = new IFrameworkRequest();
        $actionResult = $this->_routeContainer->resolve($request);

        if ($actionResult !== null)
        {
            if ($actionResult instanceof JsonActionResult)
            {
                $this->_headerService->set('Content-Type', 'application/json');
            }

            while ($actionResult instanceof PartialActionResult)
            {
                $actionResult = $this->_classFactory->callControllerAction($request, $actionResult->getControllerName(), 'index', array($actionResult));
            }

            $this->_outputBufferService->start('FormatHelper::minimizeHtml');
            $actionResult->render();
            $this->_outputBufferService->flushContent();
        }
    }
}