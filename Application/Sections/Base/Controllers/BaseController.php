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
     * @param BasePartialActionResult &$partialActionResult
     * @return IActionResult
     */
    public function index(BasePartialActionResult &$partialActionResult)
    {
        $viewModel = new BaseViewModel();
        $viewModel->title = !ValidationHelper::isNullOrEmpty($partialActionResult->title) ? "{$partialActionResult->title} - {$this->title}" : $this->title;
        $viewModel->head = new ViewActionResult('Head', null, __FILE__);
        $viewModel->topMenu = $this->topMenu();
        $viewModel->content = $partialActionResult->actionResult;
        $viewModel->footer = new ViewActionResult('Footer', null, __FILE__);
        
        return new ViewActionResult('Index', $viewModel, __FILE__);
    }

    /**
     * @return IActionResult
     */
    private function topMenu()
    {
        $viewModel = new TopMenuViewModel();
        $viewModel->links = array
        (
            'Index' => UrlHelper::getLink(array('')),
            'Route Demo' => UrlHelper::getLink(array('RouteDemo')),
            'Cookie Demo' => UrlHelper::getLink(array('CookieDemo')),
            'Session Demo' => UrlHelper::getLink(array('SessionDemo')),
            'JSON Demo' => UrlHelper::getLink(array('JsonDemo')),
            'OutputBuffer Demo' => UrlHelper::getLink(array('OutputBufferDemo')),
        );

        return new ViewActionResult('TopMenu', $viewModel, __FILE__);
    }
}