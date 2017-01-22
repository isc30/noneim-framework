<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 22/01/2017
 * Time: 1:36
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