<?php

/**
 * InvalidParameters Exception
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