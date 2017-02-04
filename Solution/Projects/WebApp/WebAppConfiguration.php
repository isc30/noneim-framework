<?php

/**
 * WebApp Configuration
 */
class WebAppConfiguration extends LazyConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        if (RuntimeConfiguration::$project === 'WebApp')
        {
            WebConfiguration::$webUrl = 'http://phpframework.local/';
        }
    }
}