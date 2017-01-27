<?php

/**
 * Route
 * @package Core
 * @subpackage Models\DTOs
 */
class Route implements IModel
{
    /** @var string */
    public $originalRoute;
    /** @var string */
    public $regexRoute;
    /** @var string */
    public $controller;
    /** @var string */
    public $method;
    /** @var string[] */
    public $arguments;
}