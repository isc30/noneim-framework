<?php

/**
 * Cookie Demo Controller
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
     * @return null|ActionResult
     */
    public function index()
    {
        if (!$this->_cookieService->exists('name'))
        {
            $this->_cookieService->set('name', 'Default-Name');
        }

        $viewModel = new CookieDemoViewModel();
        $viewModel->name = $this->_cookieService->get('name');

        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Cookie Demo";
        $actionResult->content = new View('Index', $viewModel, __FILE__);

        return $this->baseLayout($actionResult);
    }

    /**
     * @param IFrameworkRequest &$request
     * @return null|ActionResult
     */
    public function changeName(IFrameworkRequest &$request)
    {
        $name = $request->parameters->post('txtName');
        $this->_cookieService->set('name', $name);
        $this->_navigationService->redirectBack();

        return null;
    }

    /**
     * @return null|ActionResult
     */
    public function deleteName()
    {
        $this->_cookieService->delete('name');
        $this->_navigationService->redirectBack();

        return null;
    }
}