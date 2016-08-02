<?php

/**
 * Error404 Controller
 * @package Application
 * @subpackage Controllers
 */
class Error404Controller implements IController {

    /** @var IClassFactory */
    private $_classFactory;
    /** @var INavigationService */
    private $_navigationService;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * Error404Controller Constructor
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
     * @return IActionResult
     */
    public function index() {
        
        $this->_headerService->setResponseCode(404);

        $viewModel = new Error404ViewModel();
        $viewModel->request = $this->_navigationService->getSectionRequest();

        return $this->_classFactory->call('BaseController', 'index', array(
            'title' => '404 wtf',
            'content' => new ViewActionResult('Error404', $viewModel, __FILE__)
        ));

    }

}