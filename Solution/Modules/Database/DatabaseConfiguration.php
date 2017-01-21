<?php

/**
 * Database Module Configuration
 * @package Modules\Database
 */
class DatabaseConfiguration implements IConfiguration
{
    const type = 'mysql';
    const host = 'localhost';
    const customPort = null;
    const database = 'prueba';
    const username = 'root';
    const password = '';

    const persistentConnection = false;
    const charset = 'utf8';
}