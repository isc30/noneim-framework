<?php

/**
 * Exception Controller
 */
class ExceptionController extends BaseLayoutController
{
    /**
     * Main Action
     * @param WebRequest $request
     * @param Exception $ex
     * @return ActionResult
     */
    public function index(WebRequest $request, Exception $ex)
    {
        $viewModel = new ExceptionViewModel();
        $viewModel->request = FormatHelper::cleanOutput($request->section);
        $viewModel->exception = $ex;

        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'WOOPS';
        $layoutViewModel->content = RuntimeConfiguration::$debug
                                        ? new View('DebugException', $viewModel, __FILE__)
                                        : new View('Exception', $viewModel, __FILE__);

        $actionResult = $this->baseLayout($layoutViewModel);
        $actionResult->responseCode = 500;

        return $actionResult;
    }
}