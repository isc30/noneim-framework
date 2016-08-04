<?php

/**
 * Enum
 * @package Core
 * @subpackage Models\DTOs
 */
class Enum
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}