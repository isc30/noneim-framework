<?php

/**
 * Exception ViewModel
 */
class ExceptionViewModel implements IModel
{
    /**
     * Requested section
     * @var string
     */
    public $section;

    /** @var Exception */
    public $exception;
}