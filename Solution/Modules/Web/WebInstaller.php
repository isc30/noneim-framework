<?php

/**
 * Web Installer
 */
class WebInstaller extends DefaultInstaller
{
    /**
     * Install
     * @param IInstallerContainer $container
     * @return void
     */
    public static function install(IInstallerContainer $container)
    {
        $this->_installerContainer->registerDefinition('IWebRequestService', 'WebRequestService');
        $container->registerDefinition('ILogService', 'LogService');
        $container->registerDefinition('IRouteContainer', 'RouteContainer');
        $container->registerDefinition('INavigationService', 'NavigationService');
        $container->registerDefinition('ISessionService', 'SessionService');
        $container->registerDefinition('ICookieService', 'CookieService');
        $container->registerDefinition('IHeaderService', 'HeaderService');
        $container->registerDefinition('IRequestService', 'RequestService');
        $container->registerDefinition('IActionResultService', 'ActionResultService');
    }
}