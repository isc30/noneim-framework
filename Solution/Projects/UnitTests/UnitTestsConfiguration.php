<?php

/**
 * UnitTests Configuration
 */
class UnitTestsConfiguration implements IProjectLazyConfiguration
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