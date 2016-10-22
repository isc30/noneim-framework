<?php

/**
 * Index Controller
 * @package Application
 * @subpackage Controllers
 */
class IndexController implements IController
{
    /**
     * Default Action
     * @return IActionResult
     */
    public function index()
    {
        $actionResult = new BasePartialActionResult();
        $actionResult->title = 'Welcome!';
        $actionResult->actionResult = new ViewActionResult('Index', null, __FILE__);

        return $actionResult;
    }
}