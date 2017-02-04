<?php

/**
 * Core Installer
 */
class CoreInstaller extends DefaultInstaller
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container)
    {
        $container->registerDefinition('ITimeService', 'TimeService');
    }
}