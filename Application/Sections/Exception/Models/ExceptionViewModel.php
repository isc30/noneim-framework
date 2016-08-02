<?php

/**
 * Exception ViewModel
 * @package Application
 * @subpackage Models\ViewModels
 */
class ExceptionViewModel implements IViewModel {
    
    /**
     * Requested section
     * @var string
     */
    public $request;
    
    public $exception;
    
    /**
     * Error404ViewModel Constructor
     */
    use TArrayPropertiesConstructor;
    
}