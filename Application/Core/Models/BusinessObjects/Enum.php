<?php

/**
 * Enum
 * @package Core
 * @subpackage Models\BusinessObjects
 */
class Enum
{
    public $value;
    protected $default = 1;

    public function __construct($value = null)
    {
        if ($value === null)
        {
            $this->value = $this->default;
        }
        else
        {
            $this->value = $value;
        }
    }
}