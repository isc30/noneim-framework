<?php

/**
 * Web Configuration
 */
class WebConfiguration extends StaticClass
{
    /** @var bool */
    public static $prettyUrl = true;

    /** @var string */
    public static $webUrl = 'http://test.local/';
    /** @var string */
    public static $defaultSection = 'index';
    /** @var string */
    public static $sectionRequest = 'p';
    /** @var string */
    public static $subsectionSeparator = '/';

    /** @var null|int */
    public static $defaultCookieExpiration = 300; // 5 * 60
}