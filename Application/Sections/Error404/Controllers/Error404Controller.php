<?php

/**
 * Error404 Controller
 * @package Application
 * @subpackage Controllers
 */
class Error404Controller implements IController
{
    /** @var INavigationService */
    private $_navigationService;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * Error404Controller Constructor
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
     * @return IPartialActionResult
     */
    public function index(IFrameworkRequest $request)
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