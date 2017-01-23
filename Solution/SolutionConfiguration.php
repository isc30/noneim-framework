<?php

/**
 * Solution Configuration
 * @package Solution
 */
class SolutionConfiguration implements IDefaultLazyConfiguration
{
    public static $locale = 'es_ES';
    public static $timezone = 'Europe/Madrid';

    public static $projectPath;
    public static $staticPath;
    public static $resourcesPath;
    public static $cachesPath;

    // Automatic
    public static $project;
    public static $solutionPath;

    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        self::$projectPath = self::$solutionPath . 'Projects/' . self::$project . '/';
        self::$staticPath = self::$solutionPath . 'Static/';
        self::$resourcesPath = self::$solutionPath . 'Resources/';
        self::$cachesPath = self::$solutionPath . 'Caches/';

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
