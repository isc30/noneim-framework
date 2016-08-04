<?php

/**
 * Partial ActionResult Interface
 * @package Core
 * @subpackage Interfaces\Markers
 */
interface IPartialActionResult extends IActionResult
{
    /**
     * @return string
     */
    public function getControllerName();
}