<?php

/**
 * NavigationService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface INavigationService extends IService {

    /**
     * Return current section request
     * @return string
     */
    public function getSectionRequest();

    /**
     * Return current section request (as string array with element for each subsection)
     * @return string[]
     */
    public function getSectionRequestArray();

    /**
     * Redirect to url
     * @param string $url
     */
    public function redirect($url);

    /**
     * Redirect to previous page
     */
    public function redirectBack();

    /**
     * Redirect to url in X seconds
     * @param string $url
     * @param number $seconds
     */
    public function redirectIn($url, $seconds);

    /**
     * Redirect to section
     * @param string[] $sections
     */
    public function redirectSection(array $sections);

    /**
     * Redirect to section in X seconds
     * @param string[] $sections
     * @param number $seconds
     */
    public function redirectSectionIn(array $sections, $seconds);

}