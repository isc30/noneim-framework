<?php

/**
 * Assertion failed Exception
 * @package Core
 * @subpackage Exceptions
 */
class DatabaseConnectionException extends Exception
{
    /**
     * DatabaseConnectionException Constructor
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct("Error Connecting to Database: {$message}");
    }
}