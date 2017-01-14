<?php

/**
 * Assertion failed Exception
 * @package Core
 * @subpackage Exceptions
 */
class AssertionFailedException extends Exception {

    /**
     * AssertionFailedException Constructor
     */
    public function __construct() {

        parent::__construct('Assertion Failed');

    }

}