<?php

interface IConnectionContainer extends IContainer
{
    /**
     * Return PDO
     * @return PDOExtension
     */
    public function PDO();
}