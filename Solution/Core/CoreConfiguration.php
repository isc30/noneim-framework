<?php

/**
 * Core Configuration
 * @package Core
 */
class CoreConfiguration implements IConfiguration
{
    /**
     * x.y.z
     *
     * x = stable
     * y = stable (path)
     * z =
     *      0 - stable
     *      1 - alpha
     *      2 - beta
     *
     * @var string
     **/
    public static $version = '0.9.1 alpha';
}