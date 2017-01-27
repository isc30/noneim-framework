<?php

/**
 * Base Layout Controller
 * @package WebApp
 * @subpackage Controllers
 */
class BaseLayoutController implements IController
{
    /** @var string */
    private $title = 'IFramework';

    /**
     * Default Page
     * @param BaseLayoutContentViewModel $contentViewModel
     * @return IActionResult
     */
    protected function baseLayout(BaseLayoutContentViewModel $contentViewModel)
    {
        $viewModel = new BaseLayoutViewModel();
        $viewModel->title = !ValidationHelper::isNullOrEmpty($contentViewModel->title) ? "{$contentViewModel->title} - {$this->title}" : $this->title;
        $viewModel->head = new View('Head', null, __FILE__);
        $viewModel->topMenu = $this->topMenu();
        $viewModel->content = $contentViewModel->content;
        $viewModel->footer = new View('Footer', null, __FILE__);
        
        return new ViewActionResult('Index', $viewModel, __FILE__);
    }

    /**
     * @return View
     */
    private function topMenu()
    {
        $viewModel = new TopMenuViewModel();
        $viewModel->links = array
        (
            'Index' => UrlHelper::getLink(array('')),
            'Error 404 Demo' => UrlHelper::getLink(array('TROLOLOLOL')),
            'Internal Exception Demo' => UrlHelper::getLink(array('ExceptionDemo')),
            'Route Demo' => UrlHelper::getLink(array('RouteDemo')),
            'Cookie Demo' => UrlHelper::getLink(array('CookieDemo')),
            'Session Demo' => UrlHelper::getLink(array('SessionDemo')),
            'JSON Demo' => UrlHelper::getLink(array('JsonDemo')),
            'OutputBuffer Demo' => UrlHelper::getLink(array('OutputBufferDemo')),
        );

        return new View('TopMenu', $viewModel, __FILE__);
    }
}