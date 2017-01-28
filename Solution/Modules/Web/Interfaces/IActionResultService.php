<?php

/**
 * ActionResultService Interface
 * @package Modules\Web
 * @subpackage Interfaces
 */
interface IActionResultService
{
    /**
     * @param ActionResult $actionResult
     */
    public function render(ActionResult $actionResult);
}