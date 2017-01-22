<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 14/01/2017
 * Time: 15:10
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