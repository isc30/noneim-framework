<?php

/**
 * Installer Interface
 */
interface IInstaller
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container);
}