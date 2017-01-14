<?php

/**
 * Invalid parameters Exception
 * @package Core
 * @subpackage Exceptions
 */
class InvalidParametersException extends Exception {

    /**
     * InvalidParametersException Constructor
     * @param string $message
     */
    public function __construct($message = 'Invalid Parameters') {

        parent::__construct($message);

    }

}