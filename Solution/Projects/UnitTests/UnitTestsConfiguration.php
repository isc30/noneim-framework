<?php

class UnitTestsConfiguration implements IProjectLazyConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure()
    {
        if (SolutionConfiguration::$project === 'UnitTests')
        {
            // ...
        }
    }
}