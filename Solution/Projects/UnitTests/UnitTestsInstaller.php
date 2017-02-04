<?php

/**
 * UnitTests Installer
 */
class UnitTestsInstaller extends Installer
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container)
    {
        if (RuntimeConfiguration::$project === 'UnitTests')
        {
            $container->registerDefinition('ICookieService', 'CookieServiceMock');
        }
    }
}