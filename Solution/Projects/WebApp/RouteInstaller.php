<?php

/**
 * Route Installer
 * @package Solution
 */
class RouteInstaller implements IInstaller
{
    /** @var IRouteContainer */
    private $_routeContainer;
    
    /**
     * RouteInstaller Constructor
     * @param IRouteContainer $routeContainer
     */
    public function __construct(IRouteContainer $routeContainer)
    {
        $this->_routeContainer = $routeContainer;
    }
    
    /**
     * Install
     */
    public function install()
    {
        $this->_routeContainer->registerDefault('Error404Controller');
        $this->_routeContainer->registerException('ExceptionController');

        $this->_routeContainer->register(array('Index'), 'IndexController');
    }
}
