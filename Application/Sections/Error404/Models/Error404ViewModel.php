<?php

/**
 * Error404 ViewModel
 * @package Application
 * @subpackage Models\ViewModels
 */
class Error404ViewModel implements IViewModel {
    
    /**
     * Requested section
     * @var string
     */
    public $request;
    
    /**
     * Error404ViewModel Constructor
     */
    use TArrayPropertiesConstructor;
    
}