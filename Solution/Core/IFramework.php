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
     * @param string $project
     */
    public static function init($solutionDir, $project)
    {
        $startTime = microtime(true);

        // Special requires
        self::includeRequiredFiles($solutionDir);

        // Set project
        Configuration::$project = $project;

        // Init DependencyHelper
        DependencyHelper::initAutoLoader();

        // Load default lazy configuration
        foreach (ReflectionHelper::getImplementations('IDefaultLazyConfiguration') as $classDefinition)
        {
            /** @var ILazyConfiguration $className */
            $className = $classDefinition->name;
            $className::configure();
        }

        // Load lazy configurations
        foreach (ReflectionHelper::getImplementations('IProjectLazyConfiguration') as $classDefinition)
        {
            /** @var ILazyConfiguration $className */
            $className = $classDefinition->name;
            $className::configure();
        }

        // Circular dependency
        $installerContainer = new InstallerContainer();
        $classFactory = new ClassFactory();
        $installerContainer->setClassFactory($classFactory);
        $classFactory->setInstallerContainer($installerContainer);

        // Register implemented dependencies
        $installerContainer->registerImplementation('IInstallerContainer', $installerContainer);
        $installerContainer->registerImplementation('IClassFactory', $classFactory);

        // Load DependencyInstallers
        if (!CacheHelper::load('Core', "InstallerContainer", $installerContainer))
        {
            // Default installers
            foreach (ReflectionHelper::getImplementations('IDefaultInstaller') as $classDefinition)
            {
                /** @var IProjectInstaller $installer */
                $installer = $classFactory->instantiate($classDefinition->name);
                $installer->install();
            }

            // Project installers
            foreach (ReflectionHelper::getImplementations('IProjectInstaller') as $classDefinition)
            {
                /** @var IProjectInstaller $installer */
                $installer = $classFactory->instantiate($classDefinition->name);
                $installer->install();
            }

            CacheHelper::save('Core', "InstallerContainer", $installerContainer);
        }

        self::$coreLoadTime = round((microtime(true) - $startTime) * 1000, 2);

        // Run Solution
        $classFactory->call($project, 'main');
    }

    private static function includeRequiredFiles($solutionDir)
    {
        $coreDir = dirname(__FILE__) . '/';

        require_once $coreDir . 'Interfaces/Markers/IConfiguration.php';
        require_once $coreDir . 'Interfaces/ILazyConfiguration.php';
        require_once $coreDir . 'Interfaces/Markers/IDefaultLazyConfiguration.php';
        require_once $solutionDir . 'Configuration.php';

        require_once $coreDir . 'ClassDefinition.php';

        require_once $coreDir . 'CacheHelper.php';

        require_once $coreDir . 'ReflectionHelper.php';
        require_once $coreDir . 'DependencyHelper.php';
    }
}