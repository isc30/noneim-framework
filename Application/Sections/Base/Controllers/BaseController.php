<?php

/**
 * Base Controller
 * @package Application
 * @subpackage Controllers
 */
class BaseController implements IController
{
    private $title;

    public function __construct()
    {
        $this->title = 'IFramework';
    }

    /**
     * Default Page
     * @param IFrameworkRequest $request
     * @param BasePartialActionResult $partialActionResult
     * @return IActionResult
     */
    public function index(IFrameworkRequest $request, BasePartialActionResult $partialActionResult)
    {
        $viewModel = new BaseViewModel();
        $viewModel->title = !ValidationHelper::isNullOrEmpty($partialActionResult->title) ? "{$partialActionResult->title} - {$this->title}" : $this->title;
        $viewModel->head = new ViewActionResult('Head', null, __FILE__);
        $viewModel->topMenu = $this->topMenu();
        $viewModel->content = $partialActionResult->actionResult;
        $viewModel->footer = new ViewActionResult('Footer', null, __FILE__);
        
        return new ViewActionResult('Base', $viewModel, __FILE__);
    }

    /**
     * @return IActionResult
     */
    private function topMenu()
    {
        $viewModel = new TopMenuViewModel();
        $viewModel->links = array
        (
            'Index' => NavigationHelper::getLink(array('')),
            'Cookie Demo' => NavigationHelper::getLink(array('CookieDemo'))
        );

        return new ViewActionResult('TopMenu', $viewModel, __FILE__);
    }
}