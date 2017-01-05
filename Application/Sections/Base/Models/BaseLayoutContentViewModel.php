<?php

/**
 * Base Layout content ViewModel
 * @package Application
 * @subpackage Models\ViewModels
 */
class BaseLayoutContentViewModel implements IViewModel
{
    /** @var string */
    public $title;

    /** @var View */
    public $content;
}