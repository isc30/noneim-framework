<?php

interface IActionResultService
{
    /**
     * @param null|ActionResult $actionResult
     */
    public function render(ActionResult $actionResult);
}