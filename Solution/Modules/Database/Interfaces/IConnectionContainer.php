<?php

/**
 * ConnectionContainer Interface
 */
interface IConnectionContainer
{
    /**
     * Return PDO
     * @return PDOExtension
     */
    public function PDO();
}