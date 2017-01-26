<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class CookieDemoController extends BaseLayoutController
{
    private $_cookieService;
    private $_navigationService;

    /**
     * IndexController Constructor
     * @param ICookieService $cookieService
     * @param INavigationService $navigationService
     */
    public function __construct(
        ICookieService $cookieService,
        INavigationService $navigationService)
    {
        $this->_cookieService = $cookieService;
        $this->_navigationService = $navigationService;
    }

    /**
     * Default Action
     * @return null|IActionResult
     */
    public function index()
    {
        if (!$this->_cookieService->exists('name'))
        {
            $this->_cookieService->set('name', 'Default-Name', null, '/CookieDemo/');
        }

        $viewModel = new CookieDemoViewModel();
        $viewModel->name = $this->_cookieService->get('name');

        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Cookie Demo";
        $actionResult->content = new ViewActionResult('Index', $viewModel, __FILE__);

        return $this->baseLayout($actionResult);
    }

    /**
     * @param IFrameworkRequest &$request
     * @return null|IActionResult
     */
    public function changeName(IFrameworkRequest &$request)
    {
        $name = $request->parameters->post('txtName');
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