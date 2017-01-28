<?php

/**
 * Base ActionResult
 * @package Core
 * @subpackage Models\ActionResults
 */
abstract class ActionResult
{
    /** @var null|int */
    public $responseCode = null;

    /**
     * Render content
     */
    public abstract function render();
}