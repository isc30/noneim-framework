<?php

/**
 * IFramework
 * @package Core
 */
class IFramework
{
    /** @var float */
    public static $coreLoadTime;

    /**
     * No instanciable
     */
    private function __construct()
    {
    }

    /**
     * Load Core and run Solution
     * @param string $solutionDir
     * @param string $application
     */
    public static function init($solutionDir, $application)
    {
        $startTime = microtime(true);

        // Special requires
        self::includeRequiredFiles($solutionDir);

        // Init DependencyHelper
        DependencyHelper::initAutoLoader();

        // Load lazy configurations
        foreach (ReflectionHelper::getImplementations('ILazyConfiguration') as $classDefinition)
        {
            /** @var ILazyConfiguration $className */
            $className = $classDefinition->name;
            $className::configure();
        }

        // Circular dependency
        $installerContainer = new InstallerContainer($application);
        $classFactory = new ClassFactory();
        $installerContainer->setClassFactory($classFactory);
        $classFactory->setInstallerContainer($installerContainer);

        $cacheService = new CacheService();

        // Register implemented dependencies
        $installerContainer->registerImplementation('IInstallerContainer', $installerContainer);
        $installerContainer->registerImplementation('IClassFactory', $classFactory);

        // Load DependencyInstallers
        if (!$cacheService->load('Core', 'InstallerContainer', $installerContainer))
        {
            // Install Core
            $classFactory->loadInstaller('CoreInstaller');

            $projectInstallers = array();

            // Modules
            foreach (ReflectionHelper::getImplementations('IInstaller') as $classDefinition)
            {
                $path = str_replace('\\', '/', $classDefinition->path);

                if (ValidationHelper::startsWith($path, Configuration::modulesDir))
                {
                    /** @var IInstaller $installer */
                    $installer = $classFactory->instantiate($classDefinition->name);
                    $installer->install();
                }
                else
                {
                    $projectInstallers[] = $classDefinition->name;
                }
            }

            // Custom installers
            foreach ($projectInstallers as $installer)
            {
                /** @var IInstaller $installer */
                $installer = $classFactory->instantiate($installer);
                $installer->install();
            }

            $cacheService->save('Core', 'InstallerContainer', $installerContainer);
        }

        self::$coreLoadTime = round((microtime(true) - $startTime) * 1000, 2);

        // Run Solution
        $classFactory->call($application, 'main');
    }

    private static function includeRequiredFiles($solutionDir)
    {
        $coreDir = dirname(__FILE__) . '/';

        require_once $coreDir . 'Interfaces/Markers/IConfiguration.php';
        require_once $coreDir . 'Interfaces/ILazyConfiguration.php';
        require_once $solutionDir . 'Configuration.php';

        require_once $coreDir . 'ClassDefinition.php';
        require_once $coreDir . 'ReflectionHelper.php';
        require_once $coreDir . 'DependencyHelper.php';
    }
}