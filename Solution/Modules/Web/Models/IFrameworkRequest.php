<?php

/**
 * IFramework Request
 */
class IFrameworkRequest
{
    /** @var string */
    public $section;
    /** @var IFrameworkRequestParameters */
    public $parameters;
    /** @var string */
    public $type;
    /** @var WebRequestHeaders */
    public $headers;
}