<?php

/**
 * Core Installer
 * @package Core
 * @subpackage Installers
 */
class CoreInstaller implements IInstaller
{
    /** @var IInstallerContainer */
    private $_installerContainer;
    
    /**
     * CoreInstaller Constructor
     * @param IInstallerContainer $installerContainer
     */
    public function __construct(
        IInstallerContainer $installerContainer
    ) {
        $this->_installerContainer = $installerContainer;
    }
    
    /**
     * Install
     */
    public function install()
    {
        $this->_installerContainer->registerDefinition('ICacheService', 'CacheService');
        $this->_installerContainer->registerDefinition('ILogService', 'LogService');
        $this->_installerContainer->registerDefinition('INavigationService', 'NavigationService');
        $this->_installerContainer->registerDefinition('IOutputBufferService', 'OutputBufferService');
        $this->_installerContainer->registerDefinition('ISessionService', 'SessionService');
        $this->_installerContainer->registerDefinition('ICookieService', 'CookieService');
        $this->_installerContainer->registerDefinition('IHeaderService', 'HeaderService');
        $this->_installerContainer->registerDefinition('IRequestService', 'RequestService');
        $this->_installerContainer->registerDefinition('ITimeService', 'TimeService');
    }
}