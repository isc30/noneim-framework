<?php

/**
 * Created by PhpStorm.
 * User: isc
 * Date: 8/3/16
 * Time: 12:35 AM
 */
class BasePartialActionResult extends PartialActionResult
{
    public $title;
    public $actionResult;

    /**
     * @return string
     */
    public function getControllerName()
    {
        return 'BaseController';
    }
}