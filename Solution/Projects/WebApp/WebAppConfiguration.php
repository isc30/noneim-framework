<?php

/**
 * WebApp Project Configuration
 * @package WebApp
 */
class WebAppConfiguration implements IProjectLazyConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        if (SolutionConfiguration::$project === 'WebApp')
        {
            WebConfiguration::$webUrl = 'http://phpframework.local/';
        }
    }
}