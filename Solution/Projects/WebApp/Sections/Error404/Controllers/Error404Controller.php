<?php

class Error404Controller extends BaseLayoutController
{
    /**
     * Main Action
     * @param IFrameworkRequest $request
     * @return ActionResult
     */
    public function index(IFrameworkRequest $request)
    {
        $viewModel = new Error404ViewModel();
        $viewModel->request = FormatHelper::cleanOutput($request->section);

        $layoutViewModel = new BaseLayoutContentViewModel();
        $layoutViewModel->title = 'Error 404';
        $layoutViewModel->content = new View('Error404', $viewModel, __FILE__);

        $actionResult = $this->baseLayout($layoutViewModel);
        $actionResult->responseCode = 404;

        return $actionResult;
    }
}