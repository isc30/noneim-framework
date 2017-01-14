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
    public function __construct(IInstallerContainer $installerContainer)
    {
        $this->_installerContainer = $installerContainer;
    }
    
    /**
     * Install
     */
    public function install()
    {
        $this->_installerContainer->registerDefinition('ICacheService', 'CacheService');
        $this->_installerContainer->registerDefinition('ILogService', 'LogService');
        $this->_installerContainer->registerDefinition('IOutputBufferService', 'OutputBufferService');
        $this->_installerContainer->registerDefinition('ITimeService', 'TimeService');
    }
}