<?php

/**
 * Database Module Installer
 * @package Modules\Database
 * @subpackage Installers
 */
class DatabaseModuleInstaller implements IInstaller
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
        $this->_installerContainer->register('IConnectionContainer', 'ConnectionContainer');
    }
}