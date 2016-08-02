<?php

/**
 * Base Controller
 * @package Application
 * @subpackage Controllers
 */
class BaseController implements IController
{
    /**
     * BaseController Constructor
     */
    public function __construct()
    {

    }

    /**
     * Main Page
     * @param string $title
     * @param ViewActionResult $content
     * @return IActionResult
     */
    public function index($title, $content)
    {
        $viewModel = new BaseViewModel();
        $viewModel->title = !ValidationHelper::isNullOrEmpty($title) ? "$title - Tienda Igara" : 'Tienda Igara';
        $viewModel->head = new ViewActionResult('Head', null, __FILE__);
        $viewModel->topMenu = $this->topMenu();
        $viewModel->content = $content;
        $viewModel->footer = new ViewActionResult('Footer', null, __FILE__);
        
        return new ViewActionResult('Base', $viewModel, __FILE__);
    }

    /**
     * Top menu
     * @return IActionResult
     */
    private function topMenu()
    {
        $viewModel = new TopMenuViewModel();
        $viewModel->links = array(
            'Home' => NavigationHelper::getLink(array('')),
            'Demo' => NavigationHelper::getLink(array('Demo'))
        );

        return new ViewActionResult('TopMenu', $viewModel, __FILE__);
    }
}