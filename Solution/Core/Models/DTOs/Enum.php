<?php

class Enum
{
    /** @var int */
    public $value;

    /**
     * Enum constructor.
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}