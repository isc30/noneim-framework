<?php

class DependencyNotFoundException extends Exception {

    /**
     * DependencyNotFoundException Constructor
     * @param string $dependencyName
     */
    public function __construct($dependencyName) {

        parent::__construct("Dependency not found: {$dependencyName}");

    }

}