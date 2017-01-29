<?php

class ExceptionViewModel implements IViewModel
{
    /**
     * Requested section
     * @var string
     */
    public $request;

    /** @var Exception */
    public $exception;
}