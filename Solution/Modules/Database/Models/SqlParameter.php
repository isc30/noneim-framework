<?php

// PDOExtension dependency
// TODO: Strong Refactoring
class SqlParameter
{
    const BOOL = PDO::PARAM_BOOL;
    const NULL = PDO::PARAM_NULL;
    const INT = PDO::PARAM_INT;
    const STRING = PDO::PARAM_STR;
    const LOB = PDO::PARAM_LOB;

    const IN = 'IN';
    const INOUT = 'INOUT';
    const OUT = 'OUT';

    public $name = '';
    public $value = 0;
    public $type = self::STRING;
    public $behavior = self::IN;

    public function __construct($name, $value, $type = self::STRING, $behavior = self::IN)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->behavior = $behavior;
    }
}