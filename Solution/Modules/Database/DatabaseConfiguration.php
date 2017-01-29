<?php

/**
 * Database Configuration
 */
class DatabaseConfiguration implements IConfiguration
{
    /** @var string */
    public static $type = 'mysql';
    /** @var string */
    public static $host = 'localhost';
    /** @var null|int */
    public static $customPort = null;
    /** @var string */
    public static $database = 'prueba';
    /** @var string */
    public static $username = 'root';
    /** @var string */
    public static $password = '';

    /** @var bool */
    public static $persistentConnection = false;
    /** @var string */
    public static $charset = 'utf8';
}