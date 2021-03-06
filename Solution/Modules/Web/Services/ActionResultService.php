<?php

/**
 * ActionResult Service
 */
class ActionResultService implements IActionResultService
{
    /** @var IHeaderService */
    private $_headerService;
    /** @var INavigationService */
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
        $this->process($actionResult);
        $actionResult->render();
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
        elseif ($actionResult instanceof RedirectActionResult)
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
        elseif ($actionResult instanceof StreamActionResult)
        {
            $this->_headerService->set(HeaderType::ContentType, MimeType::TextOctetStream);
            $this->_headerService->set(HeaderType::CacheControl, 'no-cache');
            $this->_headerService->set('X-Accel-Buffering', 'no');
        }
    }
}