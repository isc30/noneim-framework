<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class SessionDemoController implements IController
{
    private $_sessionService;
    private $_navigationService;

    /**
     * SessionDemoController Constructor
     * @param ISessionService $sessionService
     * @param INavigationService $navigationService
     */
    public function __construct(
        ISessionService $sessionService,
        INavigationService $navigationService)
    {
        $this->_sessionService = $sessionService;
        $this->_navigationService = $navigationService;
    }

    /**
     * Default Action
     * @return null|IActionResult
     */
    public function index()
    {
        if (!$this->_sessionService->exists('name'))
        {
            $this->_sessionService->set('name', 'Default-Name');
        }

        $viewModel = new SessionDemoViewModel();
        $viewModel->name = $this->_sessionService->get('name');

        $actionResult = new BasePartialActionResult();
        $actionResult->title = "Session Demo";
        $actionResult->actionResult = new ViewActionResult('Index', $viewModel, __FILE__);

        return $actionResult;
    }

    /**
     * @param IFrameworkRequest $request
     * @return null|IActionResult
     */
    public function changeName(IFrameworkRequest &$request)
    {
        $name = $request->parameters->post('txtName');

        // Don't allow empty names
        if (!ValidationHelper::isNullOrEmpty($name))
        {
            $this->_sessionService->set('name', $name);
        }

        $this->_navigationService->redirectSection(array('SessionDemo'));
        return null;
    }

    /**
     * @return null|IActionResult
     */
    public function deleteName()
    {
        $this->_sessionService->delete('name');
        $this->_navigationService->redirectSection(array('SessionDemo'));

        return null;
    }
}