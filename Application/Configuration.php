<?php

/**
 * Default IFramework configuration file
 * @package Application
 */
class Configuration
{
    const version = '1.0.0';
    const debug = true;
    const caching = !self::debug && true;
    const prettyUrl = true;

    const locale = 'es_ES'; // nullable
    const timezone = 'Europe/Madrid'; // nullable

    const webUrl = 'http://phpframework.local/';
    const sectionRequest = 'p';
    const subsectionSeparator = '/';

    const rootDir = '/var/www/phpframework/Application/';
    const coreDir = self::rootDir . 'Core/';
    const modulesDir = self::rootDir . 'Modules/';
    const resourcesDir = self::rootDir . 'Resources/';
    const applicationCachesDir = self::rootDir . 'Caches/';
    const coreCachesDir = self::applicationCachesDir . 'Core/';
    const moduleCachesDir = self::applicationCachesDir . 'Modules/';

    public static function load()
    {
        // Display errors
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

        // Locale & TimeZone
        if (self::locale !== null)
        {
            setlocale(LC_ALL, self::locale);
        }

        if (self::timezone !== null)
        {
            date_default_timezone_set(self::timezone);
        }
    }
}