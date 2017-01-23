<?php

/**
 * WebApp Installer
 * @package WebApp
 */
class WebAppInstaller implements IProjectInstaller
{
    /** @var IInstallerContainer */
    private $_installerContainer;

    /**
     * ApplicationInstaller Constructor
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
        if (Configuration::$project === 'WebApp')
        {
            // ...
        }
    }
}
