<?php

/**
 * Exception ViewModel
 * @package Application
 * @subpackage Models\ViewModels
 */
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