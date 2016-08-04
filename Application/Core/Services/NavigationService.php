<?php

/**
 * Navigation Service
 * @package Core
 * @subpackage Services
 */
class NavigationService implements INavigationService {

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
     */
    public function redirect($url)
    {
        // TODO: $this->_headerService->setResponseCode TEMPORALLY REDIRECTED
        $this->_headerService->set('Location', $url);
    }

    /**
     * Redirect to previous page
     */
    public function redirectBack() {
    
        $referer = $this->_headerService->get('Referer');
        
        if (!ValidationHelper::isNullOrEmpty($referer)) {
            $this->redirect($referer);
        }
    
    }

    /**
     * Redirect to url in X seconds
     * @param string $url
     * @param number $seconds
     */
    public function redirectIn($url, $seconds) {

        $this->_headerService->set('Refresh', "{$seconds}; url={$url}");

    }

    /**
     * Redirect to section
     * @param string[] $sections
     */
    public function redirectSection(array $sections) {

        $this->redirect(NavigationHelper::getLink($sections));

    }

    /**
     * Redirect to section in X seconds
     * @param string[] $sections
     * @param number $seconds
     */
    public function redirectSectionIn(array $sections, $seconds) {

        $this->redirectIn(NavigationHelper::getLink($sections), $seconds);

    }
    
}