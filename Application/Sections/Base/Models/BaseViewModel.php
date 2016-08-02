<?php

/**
 * Base ViewModel
 * @package Application
 * @subpackage Models\ViewModels
 */
class BaseViewModel implements IViewModel {
    
    /** @var string */
    public $title;
    /** @var ViewActionResult */
    public $head;
    /** @var ViewActionResult */
    public $topMenu;
    /** @var ViewActionResult */
    public $content;
    /** @var ViewActionResult */
    public $footer;
    
}