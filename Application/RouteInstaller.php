<?php

/**
 * Route Installer
 * @package Application
 */
class RouteInstaller implements IInstaller {
    
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
        $this->_routeContainer->register(array('Index', 'ChangeName'), 'IndexController', 'changeName');
        $this->_routeContainer->register(array('Index', 'DeleteName'), 'IndexController', 'deleteName');

        $this->_routeContainer->register(array('CookieDemo'), 'CookieDemoController');
        $this->_routeContainer->register(array('CookieDemo', 'ChangeName'), 'CookieDemoController', 'changeName');
        $this->_routeContainer->register(array('CookieDemo', 'DeleteName'), 'CookieDemoController', 'deleteName');
    }
}