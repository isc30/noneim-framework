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
     * @return ActionResult
     */
    public function index()
    {
        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'Welcome!';
        $layoutViewModel->content = new View('Index', null, __FILE__);

        return $this->baseLayout($layoutViewModel);
    }
}