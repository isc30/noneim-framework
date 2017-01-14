<?php

/**
 * Default IFramework configuration file
 * @package Solution
 */
class Configuration
{
    const debug = false;
    const caching = !self::debug && true;

    const rootDir = '//Vboxsvr/php/php-framework/Solution/';
    const coreDir = self::rootDir . 'Core/';
    const modulesDir = self::rootDir . 'Modules/';
    const staticDir = self::rootDir . 'Static/';
    const resourcesDir = self::rootDir . 'Resources/';
    const cachesDir = self::rootDir . 'Caches/';
    const coreCachesDir = self::cachesDir . 'Core/';
    const moduleCachesDir = self::cachesDir . 'Modules/';

    const locale = 'es_ES'; // Optional
    const timezone = 'Europe/Madrid'; // Optional

    public static function load()
    {
        // Display errors in debug mode
        if (self::debug)
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
        if (defined('self::locale'))
        {
            setlocale(LC_ALL, self::locale);
        }

        if (defined('self::timezone'))
        {
            date_default_timezone_set(self::timezone);
        }
    }
}
