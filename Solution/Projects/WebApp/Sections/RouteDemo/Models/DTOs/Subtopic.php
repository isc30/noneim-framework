<?php

class Subtopic
{
    public $title;
    /** @var Message[] */
    public $messages;

    public function __construct($title = null, $messages = array())
    {
        $this->title = $title;
        $this->messages = $messages;
    }
}