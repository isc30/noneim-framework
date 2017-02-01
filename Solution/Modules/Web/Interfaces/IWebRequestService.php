<?php

/**
 * WebRequestService Interface
 */
interface IWebRequestService
{
    /**
     * @return IFrameworkRequest
     */
    public function getCurrent();
}