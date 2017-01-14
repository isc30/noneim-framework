<?php

/**
 * Base Layout ViewModel
 * @package Application
 * @subpackage Models\ViewModels
 */
class BaseLayoutViewModel implements IViewModel
{
    /** @var string */
    public $title;

    /** @var View */
    public $head;

    /** @var View */
    public $topMenu;

    /** @var View */
    public $content;

    /** @var View */
    public $footer;
}