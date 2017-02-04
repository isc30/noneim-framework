<?php

/**
 * WebRequestService Interface
 */
interface IWebRequestService
{
    /**
     * @return WebRequest
     */
    public function getCurrent();
}