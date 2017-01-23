<?php

/**
 * Default Web Module Configuration
 * @package Modules\Web
 */
class WebConfiguration implements IConfiguration
{
    public static $prettyUrl = true;

    public static $webUrl = 'http://test.local/';
    public static $defaultSection = 'index';
    public static $sectionRequest = 'p';
    public static $subsectionSeparator = '/';

    public static $defaultCookieExpiration = 300; // 5 * 60
}