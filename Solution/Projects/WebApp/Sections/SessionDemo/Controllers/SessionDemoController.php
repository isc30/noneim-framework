<?php

/**
 * Session Demo Controller
 */
class SessionDemoController extends BaseLayoutController
{
    /** @var ISessionService */
    private $_sessionService;

    /**
     * SessionDemoController Constructor
     * @param ISessionService $sessionService
     */
    public function __construct(ISessionService $sessionService)
    {
        $this->_sessionService = $sessionService;
    }

    /**
     * Default Action
     * @return null|ActionResult
     */
    public function index()
    {
        if (!$this->_sessionService->exists('name'))
        {
            $this->_sessionService->set('name', 'Default-Name');
        }

        $viewModel = new SessionDemoViewModel();
        $viewModel->name = HtmlHelper::escape($this->_sessionService->get('name'));

        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Session Demo";
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

        // Don't allow empty names
        if (!StringHelper::isNullOrEmpty($name))
        {
            $this->_sessionService->set('name', $name);
        }

        return new RedirectActionResult($request->headers->get(HeaderType::Referer));
    }

    /**
     * @param WebRequest $request
     * @return null|ActionResult
     */
    public function deleteName(WebRequest $request)
    {
        $this->_sessionService->delete('name');

        return new RedirectActionResult($request->headers->get(HeaderType::Referer));
    }
}