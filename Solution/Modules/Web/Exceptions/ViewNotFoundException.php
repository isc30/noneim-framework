<?php

/**
 * ViewActionResult not found Exception
 * @package Core
 * @subpackage Exceptions
 */
class ViewNotFoundException extends Exception {

    /**
     * ViewNotFoundException Constructor
     * @param string $viewPath
     */
    public function __construct($viewPath) {

        parent::__construct("Error loading View: {$viewPath}");

    }

}