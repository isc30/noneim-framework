<?php

/**
 * WebApp Project Configuration
 * @package WebApp
 */
class WebAppConfiguration implements IProjectLazyConfiguration
{
    public static function configure()
    {
        if (Configuration::$project === 'WebApp')
        {
            WebConfiguration::$webUrl = 'http://phpframework.local/';
        }
    }
}