<?php

/**
 * Dependency Helper
 */
class DependencyHelper implements IHelper
{
    /** @var ClassDefinition[] */
    private static $autoloaderFiles = null;

    public static function initAutoloader()
    {
        self::$autoloaderFiles = ReflectionHelper::getSolutionClasses();

        spl_autoload_register('DependencyHelper::autoload');
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    /**
     * Autoloader function
     * @param string $className
     * @throws DependencyNotFoundException
     */
    private static function autoload($className)
    {
        if (!isset(self::$autoloaderFiles[$className]))
        {
            throw new DependencyNotFoundException($className);
        }

        /** @noinspection PhpIncludeInspection */
        require_once self::$autoloaderFiles[$className]->path;

        unset(self::$autoloaderFiles[$className]);
    }
}