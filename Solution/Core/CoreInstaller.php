<?php

/**
 * Core Installer
 */
class CoreInstaller implements IDefaultInstaller
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
        $this->_installerContainer->registerDefinition('ITimeService', 'TimeService');
    }
}