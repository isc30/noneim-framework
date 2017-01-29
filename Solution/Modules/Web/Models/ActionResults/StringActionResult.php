<?php

/**
 * String ActionResult
 */
class StringActionResult extends ActionResult
{
    /** @var string */
    private $_text;

    /**
     * StringActionResult Constructor
     * @param null|string $text
     */
    public function __construct($text)
    {
        $this->_text = $text;
    }

    /**
     * Render content
     */
    public function render()
    {
        echo $this->_text;
    }
}