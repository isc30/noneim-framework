<?php

/**
 * Index Controller
 * @package Application
 * @subpackage Controllers
 */
class CookieDemoController implements IController
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
     * @return IActionResult|null
     */
    public function index()
    {
        if (!$this->_cookieService->exists('name'))
        {
            $this->_cookieService->set('name', 'Default-Name', null, '/CookieDemo/');
        }

        $viewModel = new CookieDemoViewModel();
        $viewModel->name = $this->_cookieService->get('name');

        $actionResult = new BasePartialActionResult();
        $actionResult->title = "Cookie Demo";
        $actionResult->actionResult = new ViewActionResult('Index', $viewModel, __FILE__);

        return $actionResult;
    }

    /**
     * @return IActionResult|null
     */
    public function changeName()
    {
        $name = $this->_requestService->post('txtName');
        $this->_cookieService->set('name', $name, null, '/CookieDemo/');
        $this->_navigationService->redirectSection(array('CookieDemo'));

        return null;
    }

    /**
     * @return null|IActionResult
     */
    public function deleteName()
    {
        $this->_cookieService->delete('name', '/CookieDemo/');
        $this->_navigationService->redirectSection(array('CookieDemo'));

        return null;
    }
}