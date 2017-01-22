<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 22/01/2017
 * Time: 1:20
 */
class UnitTests
{
    /**
     * UnitTests Constructor
     * @param ICookieService $cookieService
     */
    public function __construct(
        ICookieService $cookieService
    )
    {
        $this->cookieService = $cookieService;
    }

    public function main()
    {
        echo $this->cookieService->getAll();
    }
}