<?php

/**
 * Runtime Configuration
 */
class RuntimeConfiguration implements IDefaultLazyConfiguration
{
    /** @var bool */
    public static $debug = true;
    /** @var bool */
    public static $cache = false;

    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
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
    }
}