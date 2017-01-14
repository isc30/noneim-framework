<?php

/**
 * TestMethod
 * @package Core
 * @subpackage Models\DTOs
 */
class TestMethod implements IModel {

    /** @var string */
    public $name;
    /** @var bool */
    public $success;
    /** @var null|Exception */
    public $exception;

}