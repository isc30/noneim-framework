<?php

/**
 * LanguageModule Installer
 */
class LanguageInstaller implements IDefaultInstaller
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
        $this->_installerContainer->registerDefinition('ILanguageService', 'LanguageService');
    }
}