<?php

/**
 * ActionResultService Interface
 * @package Modules\Web
 * @subpackage Interfaces
 */
interface IActionResultService
{
    /**
     * @param null|ActionResult $actionResult
     */
    public function render(ActionResult $actionResult);
}