<?php

/**
 * Index Controller
 * @package Application
 * @subpackage Controllers
 */
class IndexController extends BaseLayoutController
{
    /**
     * Default Action
     * @return IActionResult
     */
    public function index()
    {
        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'Welcome!';
        $layoutViewModel->content = new ViewActionResult('Index', null, __FILE__);

        return $this->baseLayout($layoutViewModel);
    }
}