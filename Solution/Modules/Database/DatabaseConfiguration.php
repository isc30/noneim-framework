<?php

/**
 * Database Module Configuration
 * @package Modules\Database
 */
class DatabaseConfiguration implements IConfiguration
{
    public static $type = 'mysql';
    public static $host = 'localhost';
    public static $customPort = null;
    public static $database = 'prueba';
    public static $username = 'root';
    public static $password = '';

    public static $persistentConnection = false;
    public static $charset = 'utf8';
}