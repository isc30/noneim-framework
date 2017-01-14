<?php

/**
 * ConnectionContainer Interface
 * @package Modules\Database
 * @subpackage Interfaces
 */
interface IConnectionContainer extends IContainer
{
    /**
     * Return PDO
     * @return PDOExtension
     */
    public function PDO();
}