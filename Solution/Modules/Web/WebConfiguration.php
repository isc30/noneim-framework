<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 14/01/2017
 * Time: 15:25
 */
class WebConfiguration implements IConfiguration
{
    public static $prettyUrl = true;

    public static $webUrl = 'http://test.local/';
    public static $defaultSection = 'index';
    public static $sectionRequest = 'p';
    public static $subsectionSeparator = '/';

    public static $defaultCookieExpiration = 300;
}