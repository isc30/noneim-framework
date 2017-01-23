<?php

/**
 * UnitTests Project Configuration
 * @package UnitTests
 */
class UnitTestsConfiguration implements IProjectLazyConfiguration
{
    public static function configure()
    {
        if (Configuration::$project === 'UnitTests')
        {
            // ...
        }
    }
}