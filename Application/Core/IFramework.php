<?php

/**
 * IFramework
 * @package Core
 */
class IFramework {

    /** @var float */
    public static $coreLoadTime;

    /**
     * No instanciable
     */
    private function __construct() {}

    /**
     * Load Core and run Application
     */
    public static function init() {

        $startTime = microtime(true);

        // Load Configuration
        Configuration::load();

        // Init DependencyLoader
        require_once Configuration::coreDir . 'DependencyLoader.php';
        $dependencyLoader = new DependencyLoader();
        $dependencyLoader->loadDependencies();
        
        // Circular dependency
        $installerContainer = new InstallerContainer();
        $classFactory = new ClassFactory();
        $installerContainer->setClassFactory($classFactory);
        $classFactory->setInstallerContainer($installerContainer);
        
        $cacheService = new CacheService(Configuration::coreCachesDir);
        $routeContainer = new RouteContainer($classFactory);
        
        // Register implemented dependencies
        $installerContainer->register('IInstallerContainer', $installerContainer);
        $installerContainer->register('IClassFactory', $classFactory);
        $installerContainer->register('IRouteContainer', $routeContainer);

        if (!$cacheService->load('InstallerContainer', $installerContainer) || !$cacheService->load('RouteContainer', $routeContainer))
        {
            $applicationFiles = $dependencyLoader->getApplicationFiles();
            foreach ($applicationFiles as $fileName => $paths)
            {
                $fileName = substr($fileName, 0, strlen($fileName) - 4);
                if (ValidationHelper::endsWith($fileName, 'Installer') && $fileName !== 'IInstaller')
                {
                    $reflectionClass = new ReflectionClass($fileName);
                    if ($reflectionClass->implementsInterface('IInstaller'))
                    {
                        $classFactory->callFromReflectionClass($reflectionClass, 'install');
                    }
                }
            }

            $cacheService->save('InstallerContainer', $installerContainer);
            $cacheService->save('RouteContainer', $routeContainer);
        }
        
        self::$coreLoadTime = round((microtime(true) - $startTime) * 1000, 2);

        // Run Application
        $classFactory->call('Application', 'run');
    }
}