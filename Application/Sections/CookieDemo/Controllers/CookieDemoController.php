<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class CookieDemoController implements IController
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
     * @param IFrameworkRequest $request
     * @return null|IActionResult
     */
    public function index(IFrameworkRequest $request)
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
     * @param IFrameworkRequest $request
     * @return null|IActionResult
     */
    public function changeName(IFrameworkRequest $request)
    {
        $name = $request->parameters->post('txtName');
        $this->_cookieService->set('name', $name, null, '/CookieDemo/');
        $this->_navigationService->redirectSection(array('CookieDemo'));

        return null;
    }

    /**
     * @param IFrameworkRequest $request
     * @return null|IActionResult
     */
    public function deleteName(IFrameworkRequest $request)
    {
        $this->_cookieService->delete('name', '/CookieDemo/');
        $this->_navigationService->redirectSection(array('CookieDemo'));

        return null;
    }
}