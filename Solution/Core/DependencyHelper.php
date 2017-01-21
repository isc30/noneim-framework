<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 21/01/2017
 * Time: 21:58
 */
class DependencyHelper
{
    /** @var ClassDefinition[] */
    private static $autoloaderFiles = null;

    public static function initAutoLoader()
    {
        self::$autoloaderFiles = ReflectionHelper::getSolutionClasses();

        spl_autoload_register('DependencyHelper::loadDependency');
    }

    private static function loadDependency($className)
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