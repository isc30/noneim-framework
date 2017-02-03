<?php

/**
 * LanguageModule Installer
 */
class LanguageInstaller extends DefaultInstaller
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container)
    {
        $container->registerDefinition('ILanguageService', 'LanguageService');
    }
}