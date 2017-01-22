<?php

/**
 * Default IFramework configuration file
 * @package Solution
 */
class Configuration implements IDefaultLazyConfiguration
{
    public static $project;

    public static $debug = true;
    public static $caching = true;

    public static $solutionPath;
    public static $staticDir = 'Static/';
    public static $resourcesDir = 'Resources/';
    public static $cachesDir = 'Caches/';

    public static $locale = 'es_ES';
    public static $timezone = 'Europe/Madrid';

    public static $staticPath;
    public static $resourcesPath;
    public static $cachesPath;

    public static function configure()
    {
        self::$staticPath = self::$solutionPath . 'Static/';
        self::$resourcesPath = self::$solutionPath . 'Resources/';
        self::$cachesPath = self::$solutionPath . 'Caches/';

        // Display errors in debug mode
        if (self::$debug)
        {
            ini_set('display_errors', true);
            ini_set('display_startup_errors', true);
            error_reporting(E_ALL);
        }
        else
        {
            ini_set('display_errors', false);
            ini_set('display_startup_errors', false);
            error_reporting(false);
        }

        // Set locale & timezone
        if (defined('self::$locale'))
        {
            setlocale(LC_ALL, self::$locale);
        }

        if (defined('self::$timezone'))
        {
            date_default_timezone_set(self::$timezone);
        }
    }
}
