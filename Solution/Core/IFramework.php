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
     * No instantiable
     */
    private function __construct()
    {
    }

    /**
     * Load Core and run Solution
     * @param string $solutionDir
     * @param string $projectName
     */
    public static function init($solutionDir, $projectName)
    {
        $startTime = microtime(true);

        // Special requires
        self::includeRequiredFiles($solutionDir);

        // Setup main configuration
        RuntimeConfiguration::configure();
        SolutionConfiguration::$solutionDir = $solutionDir;
        SolutionConfiguration::$project = $projectName;
        SolutionConfiguration::configure();

        // Init DependencyHelper
        DependencyHelper::initAutoloader();

        // Load default lazy configuration
        foreach (ReflectionHelper::getImplementations('IDefaultLazyConfiguration') as $classDefinition)
        {
            // Exceptional case
            if ($classDefinition->name === 'RuntimeConfiguration' || $classDefinition->name === 'SolutionConfiguration')
            {
                continue; // Skip as we called `configure()` manually
            }

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
        /** @var IProject $project */
        $project = $classFactory->instantiate($projectName);
        return $project->main();
    }

    /**
     * Include initial required files
     * @param string $solutionDir
     */
    private static function includeRequiredFiles($solutionDir)
    {
        $coreDir = dirname(__FILE__) . '/';

        require_once $coreDir . 'Interfaces/Markers/IConfiguration.php';
        require_once $coreDir . 'Interfaces/ILazyConfiguration.php';
        require_once $coreDir . 'Interfaces/Markers/IDefaultLazyConfiguration.php';
        require_once $solutionDir . 'SolutionConfiguration.php';
        require_once $solutionDir . 'RuntimeConfiguration.php';

        require_once $coreDir . 'Interfaces/Markers/IHelper.php';
        require_once $coreDir . 'Helpers/CacheHelper.php';

        require_once $coreDir . 'Models/DTOs/ClassDefinition.php';
        require_once $coreDir . 'Helpers/ReflectionHelper.php';
        require_once $coreDir . 'Helpers/DependencyHelper.php';
    }
}