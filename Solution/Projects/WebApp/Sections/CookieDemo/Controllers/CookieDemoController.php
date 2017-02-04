<?php

/**
 * Cookie Demo Controller
 */
class CookieDemoController extends BaseLayoutController
{
    private $_cookieService;

    /**
     * IndexController Constructor
     * @param ICookieService $cookieService
     */
    public function __construct(ICookieService $cookieService)
    {
        $this->_cookieService = $cookieService;
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
     * @param WebRequest $request
     * @return null|ActionResult
     */
    public function changeName(WebRequest $request)
    {
        $name = $request->parameters->post('txtName');
        $this->_cookieService->set('name', $name);

        return new RedirectActionResult($request->headers->get(HeaderType::Referer));
    }

    /**
     * @param WebRequest $request
     * @return null|ActionResult
     */
    public function deleteName(WebRequest $request)
    {
        $this->_cookieService->delete('name');

        return new RedirectActionResult($request->headers->get(HeaderType::Referer));
    }
}