<?php

/**
 * Database Installer
 */
class DatabaseInstaller implements IDefaultInstaller
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
        $this->_installerContainer->registerDefinition('IConnectionContainer', 'ConnectionContainer');
    }
}