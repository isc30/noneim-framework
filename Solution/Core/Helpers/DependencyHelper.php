<?php

/**
 * Dependency Helper
 * @package Core
 * @subpackage Helpers
 */
class DependencyHelper implements IHelper
{
    /** @var ClassDefinition[] */
    private static $autoloaderFiles = null;

    public static function initAutoLoader()
    {
        self::$autoloaderFiles = ReflectionHelper::getSolutionClasses();

        spl_autoload_register('DependencyHelper::autoload');
    }

    /**
     * Autoloader function
     * @param string $className
     */
    private static function autoload($className)
    {
        if (isset(self::$autoloaderFiles[$className]))
        {
            /** @noinspection PhpIncludeInspection */
            require_once self::$autoloaderFiles[$className]->path;

            unset(self::$autoloaderFiles[$className]);
        }

        unset(self::$autoloaderFiles[$className]);
    }
}