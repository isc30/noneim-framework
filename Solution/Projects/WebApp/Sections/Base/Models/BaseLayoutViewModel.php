<?php

/**
 * BaseLayout ViewModel
 */
class BaseLayoutViewModel implements IModel
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