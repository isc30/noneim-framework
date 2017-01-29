<?php

/**
 * ActionResult
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