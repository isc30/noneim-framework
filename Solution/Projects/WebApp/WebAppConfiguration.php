<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 14/01/2017
 * Time: 15:10
 */
class WebAppConfiguration
{


    public static function transform()
    {
        WebConfiguration::$webUrl = 'http://phpframework.local/';
    }
}