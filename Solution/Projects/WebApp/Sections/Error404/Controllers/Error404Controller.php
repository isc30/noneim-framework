<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class Error404Controller extends BaseLayoutController
{
    /** @var IHeaderService */
    private $_headerService;

    /**
     * Error404Controller Constructor
     * @param IHeaderService $headerService
     */
    public function __construct(IHeaderService $headerService)
    {
        $this->_headerService = $headerService;
    }

    /**
     * Main Action
     * @param IFrameworkRequest $request
     * @return IActionResult
     */
    public function index(IFrameworkRequest $request)
    {
        $this->_headerService->setResponseCode(404);

        $viewModel = new Error404ViewModel();
        $viewModel->request = FormatHelper::cleanOutput($request->section);

        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'Error 404';
        $layoutViewModel->content = new View('Error404', $viewModel, __FILE__);

        return $this->baseLayout($layoutViewModel);
    }
}