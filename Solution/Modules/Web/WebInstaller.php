<?php

/**
 * Web Installer
 */
class WebInstaller implements IDefaultInstaller
{
    /** @var IInstallerContainer */
    private $_installerContainer;

    /**
     * DatabaseModuleInstaller Constructor
     * @param IInstallerContainer $installerContainer
     */
    public function __construct(IInstallerContainer $installerContainer)
    {
        $this->_installerContainer = $installerContainer;
    }

    /**
     * Install
     */
    public function install()
    {
        $this->_installerContainer->registerDefinition('IRouteContainer', 'RouteContainer');
        $this->_installerContainer->registerDefinition('INavigationService', 'NavigationService');
        $this->_installerContainer->registerDefinition('ISessionService', 'SessionService');
        $this->_installerContainer->registerDefinition('ICookieService', 'CookieService');
        $this->_installerContainer->registerDefinition('IHeaderService', 'HeaderService');
        $this->_installerContainer->registerDefinition('IRequestService', 'RequestService');
        $this->_installerContainer->registerDefinition('IActionResultService', 'ActionResultService');
    }
}