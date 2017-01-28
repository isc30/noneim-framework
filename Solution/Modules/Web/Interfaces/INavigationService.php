<?php

/**
 * NavigationService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface INavigationService extends IService
{
    /**
     * Redirect to url
     * @param string $url
     * @param int $waitSeconds
     */
    public function redirect($url, $waitSeconds = 0);

    /**
     * Redirect to section
     * @param string[] $section
     * @param int $waitSeconds
     */
    public function redirectSection(array $section, $waitSeconds = 0);
}