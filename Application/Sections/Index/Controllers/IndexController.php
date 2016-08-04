<?php

/**
 * Index Controller
 * @package Application
 * @subpackage Controllers
 */
class IndexController implements IController
{
    private $_requestService;
    private $_cookieService;
    private $_navigationService;

    /**
     * IndexController Constructor
     * @param IRequestService $requestService
     * @param ICookieService $cookieService
     * @param INavigationService $navigationService
     */
    public function __construct(
        IRequestService $requestService,
        ICookieService $cookieService,
        INavigationService $navigationService)
    {
        $this->_requestService = $requestService;
        $this->_cookieService = $cookieService;
        $this->_navigationService = $navigationService;
    }

    /**
     * Default Action
     * @return IActionResult
     */
    public function index()
    {
        if (!$this->_cookieService->exists('name'))
        {
            $this->_cookieService->set('name', 'Default-Name', null, '/');
        }

        $viewModel = new IndexViewModel();
        $viewModel->name = $this->_cookieService->get('name');

        $actionResult = new BasePartialActionResult();
        $actionResult->title = "Indeex!";
        $actionResult->actionResult = new ViewActionResult('Index', $viewModel, __FILE__);

        return $actionResult;
    }

    /**
     * @return null|IActionResult
     */
    public function changeName()
    {
        // $request->parameters->get, post, any
        // $request->session->get, getAll
        // $request->cookies->get, getAll
        // $request->headers->get, getAll
        $newName = $this->_requestService->post('txtName');
        $this->_cookieService->set('name', $newName, null, '/');
        $this->_navigationService->redirectSection(array('Index'));
        return null;
    }

    /**
     * @return null|IActionResult
     */
    public function deleteName()
    {
        $this->_cookieService->delete('name', '/');
        $this->_navigationService->redirectSection(array('Index'));
        return null;
    }
}