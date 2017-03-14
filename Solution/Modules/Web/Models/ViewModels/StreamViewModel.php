<?php

/**
 * Stream ViewModel
 */
class StreamViewModel implements IModel
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}