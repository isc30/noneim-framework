<?php

/**
 * Default IFramework configuration file
 * @package Application
 */
class Configuration
{
    const version = '1.0.0';

    const debug = false;
    const caching = !self::debug && true;
    const prettyUrl = true;

    const webUrl = 'http://phpframework.local/';
    const defaultSection = 'index';
    const sectionRequest = 'p';
    const subsectionSeparator = '/';

    const rootDir = '/var/www/php-framework/Application/';
    const coreDir = self::rootDir . 'Core/';
    const modulesDir = self::rootDir . 'Modules/';
    const staticDir = self::rootDir . 'Static/';
    const resourcesDir = self::rootDir . 'Resources/';
    const applicationCachesDir = self::rootDir . 'Caches/';
    const coreCachesDir = self::applicationCachesDir . 'Core/';
    const moduleCachesDir = self::applicationCachesDir . 'Modules/';

    const defaultCookieExpiration = 5 * 60; // Optional

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
