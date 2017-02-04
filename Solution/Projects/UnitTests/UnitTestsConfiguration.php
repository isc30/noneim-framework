<?php

/**
 * UnitTests Configuration
 */
class UnitTestsConfiguration extends LazyConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        if (RuntimeConfiguration::$project === 'UnitTests')
        {
            // ...
        }
    }
}