<?php

/**
 * Authentication Module Installer
 * @package Modules\Authentication
 */
class AuthenticationInstaller implements IInstaller
{
    /** @var IInstallerContainer */
    private $_installerContainer;

    /**
     * AuthModuleInstaller Constructor
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
        $this->_installerContainer->register('IAuthenticationServiceBase', 'AuthenticationService');
    }
}