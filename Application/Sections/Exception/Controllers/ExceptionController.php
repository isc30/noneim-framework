<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class ExceptionController implements IController
{
    private $_navigationService;
    private $_headerService;

    /**
     * ExceptionController Constructor
     * @param INavigationService $navigationService
     * @param IHeaderService $headerService
     */
    public function __construct(
        INavigationService $navigationService,
        IHeaderService $headerService
    ) {
        $this->_navigationService = $navigationService;
        $this->_headerService = $headerService;
    }

    /**
     * Main Action
     * @param IFrameworkRequest &$request
     * @param Exception &$ex
     * @return IActionResult
     */
    public function index(IFrameworkRequest &$request, Exception &$ex) {

        $this->_headerService->setResponseCode(500);

        $viewModel = new ExceptionViewModel();
        $viewModel->request = $request->section;
        $viewModel->exception = &$ex;

        $actionResult = new BasePartialActionResult();
        $actionResult->title = 'WOOPS';
        $actionResult->actionResult = new ViewActionResult('Exception', $viewModel, __FILE__);

        return $actionResult;

    }

}