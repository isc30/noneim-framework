<?php

/**
 * Solution Configuration
 * @package Solution
 */
class SolutionConfiguration implements IDefaultLazyConfiguration
{
    /** @var string */
    public static $locale = 'es_ES';
    /** @var string */
    public static $timezone = 'Europe/Madrid';

    /** @var string */
    public static $projectDir;
    /** @var string */
    public static $staticDir;
    /** @var string */
    public static $resourcesDir;
    /** @var string */
    public static $cachesDir;

    //////////////////////////////////////////
    // Automatic

    /** @var string */
    public static $project;
    /** @var string */
    public static $solutionDir;

    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        self::$projectDir = self::$solutionDir . 'Projects/' . self::$project . '/';
        self::$staticDir = self::$solutionDir . 'Static/';
        self::$resourcesDir = self::$solutionDir . 'Resources/';
        self::$cachesDir = self::$solutionDir . 'Caches/';

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
