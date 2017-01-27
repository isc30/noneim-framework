<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class OutputBufferDemoController extends BaseLayoutController
{
    private $_outputBufferService;

    /**
     * @param IOutputBufferService $outputBufferService
     */
    public function __construct(IOutputBufferService $outputBufferService)
    {
        $this->_outputBufferService = $outputBufferService;
    }

    /**
     * Default Action
     * @return null|IActionResult
     */
    public function index()
    {
        $this->_outputBufferService->start(); // Start getting the output

        // Print some content to the OutputBuffer
        $sectionRoot = dirname(dirname(__FILE__)) . '/';
        require $sectionRoot . 'Static/Demo.phtml';;

        $content = $this->_outputBufferService->getContent(); // Get all the content
        $this->_outputBufferService->end(); // End getting the output

        $viewModel = new OutputBufferDemoViewModel();
        $viewModel->content = $content;

        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "Output Buffer Demo";
        $actionResult->content = new View('Index', $viewModel, __FILE__);

        return $this->baseLayout($actionResult);
    }
}