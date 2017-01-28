<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class TemplatingDemoController extends BaseLayoutController
{
    /**
     * Default Action
     * @return null|ActionResult
     */
    public function index()
    {
        $template1 = new View('Templates/Demo', null, __FILE__);

        $template2ViewModel = new DynamicViewModel(); // I know, it's dirty but fast
        $template2ViewModel->name = 'JOHN BROWN';
        $template2 = new View('Templates/Demo2', $template2ViewModel, __FILE__);

        $contents = array(
            $template1->renderToString(),
            $template2->renderToString()
        );

        $viewModel = new TemplatingDemoViewModel();
        $viewModel->contents = $contents;

        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Output Buffer Demo";
        $actionResult->content = new View('Index', $viewModel, __FILE__);

        return $this->baseLayout($actionResult);
    }
}