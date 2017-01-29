<?php

class SqlException extends Exception {

    /**
     * SqlException Constructor
     * @param string $message
     */
    public function __construct($message = 'Sql Exception') {

        parent::__construct($message);

    }

}