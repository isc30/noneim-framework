<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 14/01/2017
 * Time: 15:25
 */
class WebConfiguration implements IConfiguration
{
    const prettyUrl = true;

    public static $webUrl = 'http://test.local/';
    const defaultSection = 'index';
    const sectionRequest = 'p';
    const subsectionSeparator = '/';

    const defaultCookieExpiration = 300;
}