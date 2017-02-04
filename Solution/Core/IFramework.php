<?php

/**
 * IFramework
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
        RuntimeConfiguration::$project = $projectName;
        RuntimeConfiguration::configure();
        SolutionConfiguration::$solutionDir = $solutionDir;
        SolutionConfiguration::configure();

        // Init DependencyHelper
        DependencyHelper::initAutoloader();

        // Load Lazy Configurations
        self::loadLazyConfigurations();

        // Create vital dependencies
        $installerContainer = new InstallerContainer();
        $classFactory = new ClassFactory();
        $installerContainer->setClassFactory($classFactory);
        $classFactory->setInstallerContainer($installerContainer);

        // Register vital dependencies
        $installerContainer->registerImplementation('IInstallerContainer', $installerContainer);
        $installerContainer->registerImplementation('IClassFactory', $classFactory);

        // Load DependencyInstallers
        self::loadInstallers($installerContainer);

        // Benchmark :D
        self::$coreLoadTime = round((microtime(true) - $startTime) * 1000, 2);

        // Run Project
        /** @var Project $project */
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

        require_once $coreDir . 'Models/StaticClass.php';

        require_once $coreDir . 'Interfaces/ILazyConfiguration.php';
        require_once $coreDir . 'Models/LazyConfiguration.php';
        require_once $coreDir . 'Models/DefaultLazyConfiguration.php';
        require_once $solutionDir . 'SolutionConfiguration.php';
        require_once $solutionDir . 'RuntimeConfiguration.php';

        require_once $coreDir . 'Interfaces/Markers/IHelper.php';
        require_once $coreDir . 'Helpers/CacheHelper.php';

        require_once $coreDir . 'Models/ClassDefinition.php';
        require_once $coreDir . 'Helpers/ReflectionHelper.php';
        require_once $coreDir . 'Helpers/DependencyHelper.php';
    }

    /**
     * Load Lazy Configurations
     */
    private static function loadLazyConfigurations()
    {
        $lazyConfigurations = ReflectionHelper::getSubclasses('LazyConfiguration');

        // Default Lazy Configurations
        foreach ($lazyConfigurations as $index => $classDefinition)
        {
            /** @var LazyConfiguration $className */
            $className = $classDefinition->name;

            if ($className::$isDefault)
            {
                // Omit vital (and already loaded) Configurations
                if ($classDefinition->name !== 'RuntimeConfiguration'
                    && $classDefinition->name !== 'SolutionConfiguration')
                {
                    $className::configure();
                }

                unset($lazyConfigurations[$index]);
            }
        }

        // Non-Default Lazy Configurations
        foreach ($lazyConfigurations as $classDefinition)
        {
            /** @var LazyConfiguration $className */
            $className = $classDefinition->name;
            $className::configure();
        }
    }

    /**
     * Load Installers
     * @param IInstallerContainer $installerContainer
     */
    private static function loadInstallers(IInstallerContainer $installerContainer)
    {
        if (!CacheHelper::load('Core', 'InstallerContainer', $installerContainer))
        {
            $installers = ReflectionHelper::getSubclasses('Installer');

            // Default installers
            foreach ($installers as $index => $classDefinition)
            {
                /** @var Installer $className */
                $className = $classDefinition->name;

                if ($className::$isDefault)
                {
                    $className::install($installerContainer);
                    unset($installers[$index]);
                }
            }

            // Non-Default installers
            foreach ($installers as $classDefinition)
            {
                /** @var Installer $className */
                $className = $classDefinition->name;
                $className::install($installerContainer);
            }

            CacheHelper::save('Core', 'InstallerContainer', $installerContainer);
        }
    }
}