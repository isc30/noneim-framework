<?php

/**
 * Route Installer
 * @package Solution
 */
class RouteInstaller implements IInstaller
{
    /** @var IRouteContainer */
    private $_routeContainer;
    /** @var ICacheService */
    private $_cacheService;

    /**
     * RouteInstaller Constructor
     * @param IRouteContainer $routeContainer
     * @param ICacheService $cacheService
     */
    public function __construct(
        IRouteContainer $routeContainer,
        ICacheService $cacheService)
    {
        $this->_routeContainer = $routeContainer;
        $this->_cacheService = $cacheService;
    }
    
    /**
     * Install
     */
    public function install()
    {
        if (!$this->_cacheService->load('WebApp', 'RouteContainer', $this->_cacheService))
        {
            $this->_routeContainer->registerDefault('Error404Controller');
            $this->_routeContainer->registerException('ExceptionController');

            $this->_routeContainer->register(array('Index'), 'IndexController');

            $this->_cacheService->save('WebApp', 'RouteContainer', $this->_cacheService);
        }
    }
}
