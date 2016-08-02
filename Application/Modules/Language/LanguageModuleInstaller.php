<?php

/**
 * Language Module Installer
 * @package Modules\Language
 * @subpackage Installers
 */
class LanguageModuleInstaller implements IInstaller
{
    /** @var IInstallerContainer */
    private $_installerContainer;

    /**
     * LanguageModuleInstaller Constructor
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
        $this->_installerContainer->register('ILanguageService', 'LanguageService');
    }
}