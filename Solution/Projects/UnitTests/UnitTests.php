<?php

/**
 * UnitTests Project
 */
class UnitTests extends Project
{
    private $_cookieService;

    /**
     * UnitTests Constructor
     * @param ICookieService $cookieService
     */
    public function __construct(
        ICookieService $cookieService
    )
    {
        $this->_cookieService = $cookieService;
    }

    /**
     * Run project
     */
    public function main()
    {
        echo $this->_cookieService->getAll();
    }
}