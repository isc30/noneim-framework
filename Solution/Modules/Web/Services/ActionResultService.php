<?php

/**
 * ActionResult Service
 * @package Core
 * @subpackage Services
 */
class ActionResultService implements IActionResultService
{
    private $_headerService;
    private $_navigationService;

    /**
     * ActionResultService constructor.
     * @param IHeaderService $headerService
     * @param INavigationService $navigationService
     */
    public function __construct(
        IHeaderService $headerService,
        INavigationService $navigationService)
    {
        $this->_headerService = $headerService;
        $this->_navigationService = $navigationService;
    }

    /**
     * @param ActionResult $actionResult
     */
    public function render(ActionResult $actionResult)
    {
        if ($actionResult === null)
        {
            return;
        }

        $this->process($actionResult);

        OutputBufferHelper::start('FormatHelper::minimizeHtml');
        {
            $actionResult->render();
        }
        OutputBufferHelper::flushAndEnd();
    }

    /**
     * @param ActionResult $actionResult
     */
    private function process(ActionResult $actionResult)
    {
        if ($actionResult->responseCode !== null)
        {
            $this->_headerService->setResponseCode($actionResult->responseCode);
        }

        if ($actionResult instanceof JsonActionResult)
        {
            $this->_headerService->set(HeaderType::ContentType, MimeType::Json);
        }

        if ($actionResult instanceof RedirectActionResult)
        {
            if ($actionResult->isSection())
            {
                $this->_navigationService->redirectSection($actionResult->urlOrSection, $actionResult->waitSeconds);
            }
            else
            {
                $this->_navigationService->redirect($actionResult->urlOrSection, $actionResult->waitSeconds);
            }
        }
    }
}