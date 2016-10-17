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
        $this->_installerContainer->register('ICacheService', 'CacheService');
        $this->_installerContainer->register('ILogService', 'LogService');
        $this->_installerContainer->register('INavigationService', 'NavigationService');
        $this->_installerContainer->register('IOutputBufferService', 'OutputBufferService');
        $this->_installerContainer->register('ISessionService', 'SessionService');
        $this->_installerContainer->register('ICookieService', 'CookieService');
        $this->_installerContainer->register('IHeaderService', 'HeaderService');
        $this->_installerContainer->register('IRequestService', 'RequestService');
        $this->_installerContainer->register('ITimeService', 'TimeService');
    }
}