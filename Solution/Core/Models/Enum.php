<?php

/**
 * Enum
 */
class Enum
{
    /** @var int|string */
    public $value;

    /**
     * Enum Constructor
     * @param int|string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}