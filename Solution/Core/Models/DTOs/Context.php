<?php

/**
 * Context
 * @package Core
 * @subpackage Models\DTOs
 */
class Context implements IModel {

    /** @var float */
    public $time;
    /** @var int */
    public $sessionId;
    /** @var mixed[] */
    public $session;
    /** @var string[] */
    public $get;
    /** @var string[] */
    public $post;
    /** @var string[] */
    public $request;
    /** @var string[] */
    public $headers;

}