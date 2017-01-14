<?php

/**
 * Invalid operation Exception
 * @package Core
 * @subpackage Exceptions
 */
class InvalidOperationException extends Exception {

    /**
     * InvalidOperationException Constructor
     * @param string $message
     */
    public function __construct($message = 'Invalid Operation') {

        parent::__construct($message);

    }

}