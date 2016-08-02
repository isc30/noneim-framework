<?php

/**
 * Navigation Service
 * @package Core
 * @subpackage Services
 */
class NavigationService implements INavigationService {

    /** @var IRequestService */
    private $_requestService;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * NavigationService Contructor
     * @param IRequestService $requestService
     * @param IHeaderService $headerService
     */
    public function __construct(
        IRequestService $requestService,
        IHeaderService $headerService
    ) {
        $this->_requestService = $requestService;
        $this->_headerService = $headerService;
    }

    /**
     * Return current section request
     * @return string
     */
    public function getSectionRequest() {

        $request = strtolower($this->_requestService->get(Configuration::sectionRequest));
        return $request !== '' && $request !== null ? $request : 'index';
        
    }

    /**
     * Return current section request (as string array with element for each subsection)
     * @return string[]
     */
    public function getSectionRequestArray() {
        
        return NavigationHelper::getSectionArray(self::getSectionRequest());
        
    }

    /**
     * Redirect to url
     * @param string $url
     */
    public function redirect($url) {

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