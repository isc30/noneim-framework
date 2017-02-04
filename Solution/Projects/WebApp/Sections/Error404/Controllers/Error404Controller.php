<?php

/**
 * Error 404 Controller
 */
class Error404Controller extends BaseLayoutController
{
    /**
     * Main Action
     * @param WebRequest $request
     * @return ActionResult
     */
    public function index(WebRequest $request)
    {
        $viewModel = new Error404ViewModel();
        $viewModel->section = FormatHelper::cleanOutput($request->section);

        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'Error 404';
        $layoutViewModel->content = new View('Error404', $viewModel, __FILE__);

        $actionResult = $this->baseLayout($layoutViewModel);
        $actionResult->responseCode = 404;

        return $actionResult;
    }
}