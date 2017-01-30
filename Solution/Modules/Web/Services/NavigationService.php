<?php

/**
 * Navigation Service
 */
class NavigationService implements INavigationService
{
    /** @var IHeaderService */
    private $_headerService;

    /**
     * NavigationService Contructor
     * @param IHeaderService $headerService
     */
    public function __construct(IHeaderService $headerService)
    {
        $this->_headerService = $headerService;
    }

    /**
     * Redirect to url
     * @param string $url
     * @param int $waitSeconds
     */
    public function redirect($url, $waitSeconds = 0)
    {
        if ($waitSeconds > 0)
        {
            $this->_headerService->set(HeaderType::Refresh, "{$waitSeconds}; url={$url}");
        }
        else
        {
            $this->_headerService->set(HeaderType::Location, $url);
        }
    }

    /**
     * Redirect to section
     * @param string[] $section
     * @param int $waitSeconds
     */
    public function redirectSection(array $section, $waitSeconds = 0)
    {
        $this->redirect(UrlHelper::getLink($section), $waitSeconds);
    }

    /** Remove this */
    public function redirectBack()
    {
        $referer = $this->_headerService->get(HeaderType::Referer);
        $this->redirect($referer);
    }
}