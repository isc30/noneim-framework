<?php

/**
 * Exception Controller
 * @package Application
 * @subpackage Controllers
 */
class ExceptionController implements IController {
    
    /** @var IClassFactory */
    private $_classFactory;
    /** @var INavigationService */
    private $_navigationService;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * ExceptionController Constructor
     * @param IClassFactory $classFactory
     * @param INavigationService $navigationService
     * @param IHeaderService $headerService
     */
    public function __construct(
        IClassFactory $classFactory,
        INavigationService $navigationService,
        IHeaderService $headerService
    ) {
        $this->_classFactory = $classFactory;
        $this->_navigationService = $navigationService;
        $this->_headerService = $headerService;
    }

    /**
     * Main Action
     * @param IFrameworkRequest $request
     * @param Exception $ex
     * @return IActionResult
     */
    public function index(IFrameworkRequest $request, Exception $ex) {

        $this->_headerService->setResponseCode(500);

        $viewModel = new ExceptionViewModel();
        $viewModel->request = $request->section;
        $viewModel->exception = $ex;

        $actionResult = new BasePartialActionResult();
        $actionResult->title = 'WOOPS';
        $actionResult->actionResult = new ViewActionResult('Exception', $viewModel, __FILE__);

        return $actionResult;

    }

}