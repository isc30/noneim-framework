<?php

/**
 * ActionResultService Interface
 */
interface IActionResultService
{
    /**
     * @param ActionResult $actionResult
     */
    public function render(ActionResult $actionResult);
}