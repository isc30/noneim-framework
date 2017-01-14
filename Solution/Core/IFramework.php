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
     * Load Core and run Solution
     * @param string $application
     */
    public static function init($application) {

        $startTime = microtime(true);

        // Load Configuration
        Configuration::load();

        // Init DependencyLoader
        /** @noinspection PhpIncludeInspection */
        require_once Configuration::coreDir . 'DependencyLoader.php';

        $dependencyLoader = new DependencyLoader();
        $dependencyLoader->loadDependencies();
        
        // Circular dependency
        $installerContainer = new InstallerContainer();
        $classFactory = new ClassFactory();
        $installerContainer->setClassFactory($classFactory);
        $classFactory->setInstallerContainer($installerContainer);
        
        $cacheService = new CacheService(Configuration::coreCachesDir);
        
        // Register implemented dependencies
        $installerContainer->registerImplementation('IInstallerContainer', $installerContainer);
        $installerContainer->registerImplementation('IClassFactory', $classFactory);

        // Load DependencyInstallers
        if (!$cacheService->load('Core', 'InstallerContainer', $installerContainer))
        {
            $applicationFiles = $dependencyLoader->getApplicationFiles();

            // Core
            $classFactory->loadInstaller('CoreInstaller');

            // Modules
            foreach ($applicationFiles as $fileName => $paths)
            {
                $fileName = substr($fileName, 0, strlen($fileName) - 4);

                if (ValidationHelper::endsWith($fileName, 'Installer'))
                {
                    foreach ($paths as $path)
                    {
                        $path = str_replace('\\', '/', $path);

                        if (ValidationHelper::startsWith($path, Configuration::modulesDir))
                        {
                            $classFactory->loadInstaller($fileName);
                        }
                    }
                }
            }

            /*// WebApp
            if (ArrayHelper::keyExists($applicationFiles, 'ApplicationInstaller.php'))
            {
                $classFactory->loadInstaller('ApplicationInstaller');
            }*/

            $cacheService->save('Core', 'InstallerContainer', $installerContainer);
        }
        
        self::$coreLoadTime = round((microtime(true) - $startTime) * 1000, 2);

        // Run Solution
        $classFactory->call($application, 'main');
    }
}