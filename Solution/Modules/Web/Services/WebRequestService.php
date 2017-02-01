<?php

/**
 * WebRequest Service
 */
class WebRequestService implements IWebRequestService
{
    /**
     * @return IFrameworkRequest
     */
    public function getCurrent()
    {
        return new IFrameworkRequest();
    }
}