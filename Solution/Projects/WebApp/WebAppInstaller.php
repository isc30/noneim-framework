<?php

/**
 * WebApp Installer
 */
class WebAppInstaller extends Installer
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container)
    {
        if (SolutionConfiguration::$project === 'WebApp')
        {
            // ...
        }
    }
}
