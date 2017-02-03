<?php

/**
 * Database Installer
 */
class DatabaseInstaller extends DefaultInstaller
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container)
    {
        $container->registerDefinition('IConnectionContainer', 'ConnectionContainer');
    }
}