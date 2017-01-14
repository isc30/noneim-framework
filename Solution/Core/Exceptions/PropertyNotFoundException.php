<?php

/**
 * Property not found Exception
 * @package Core
 * @subpackage Exceptions
 */
class PropertyNotFoundException extends Exception {

    /**
     * PropertyNotFoundException Constructor
     * @param string $property Property name
     */
    public function __construct($property) {

        parent::__construct("Property not found: {$property}");

    }

}