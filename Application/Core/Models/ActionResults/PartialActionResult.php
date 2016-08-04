<?php

/**
 * Created by PhpStorm.
 * User: isc
 * Date: 8/3/16
 * Time: 5:19 PM
 */
abstract class PartialActionResult implements IPartialActionResult
{
    /**
     * @return string
     */
    public abstract function getControllerName();

    /**
     * Render content
     */
    public function render() {}
}