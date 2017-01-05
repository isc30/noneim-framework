<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class ExceptionController extends BaseLayoutController
{
    /** @var IHeaderService& */
    private $_headerService;

    /**
     * ExceptionController Constructor
     * @param IHeaderService $headerService
     */
    public function __construct(IHeaderService& $headerService)
    {
        $this->_headerService = $headerService;
    }

    /**
     * Main Action
     * @param IFrameworkRequest& $request
     * @param Exception& $ex
     * @return IActionResult
     */
    public function index(IFrameworkRequest& $request, Exception& $ex)
    {
        $this->_headerService->setResponseCode(500);

        $viewModel = new ExceptionViewModel();
        $viewModel->request = $request->section;
        $viewModel->exception = &$ex;

        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'WOOPS';
        $layoutViewModel->content = new View('Exception', $viewModel, __FILE__);

        return $this->baseLayout($layoutViewModel);
    }
}