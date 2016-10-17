<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class Error404Controller implements IController
{
    /** @var IHeaderService */
    private $_headerService;

    /**
     * Error404Controller Constructor
     * @param IHeaderService $headerService
     */
    public function __construct(
        IHeaderService $headerService
    ) {
        $this->_headerService = $headerService;
    }

    /**
     * Main Action
     * @param IFrameworkRequest &$request
     * @return IActionResult
     */
    public function index(IFrameworkRequest &$request)
    {
        $this->_headerService->setResponseCode(404);

        $viewModel = new Error404ViewModel();
        $viewModel->request = $request->section;

        $actionResult = new BasePartialActionResult();
        $actionResult->title = 'Error 404';
        $actionResult->actionResult = new ViewActionResult('Error404', $viewModel, __FILE__);

        return $actionResult;
    }
}