<?php

/**
 * Enum
 */
class Enum
{
    /** @var mixed */
    public $value;

    /**
     * Enum Constructor
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}