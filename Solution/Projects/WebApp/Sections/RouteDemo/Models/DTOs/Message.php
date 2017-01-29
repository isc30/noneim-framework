<?php

class Message
{
    public $user;
    public $message;

    public function __construct($user = null, $message = null)
    {
        $this->user = $user;
        $this->message = $message;
    }
}