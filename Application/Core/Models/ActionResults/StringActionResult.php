<?php

/**
 * String ActionResult
 * @package Core
 * @subpackage Models\ActionResults
 */
class StringActionResult implements IActionResult {

    /** @var string */
    private $text;

    /**
     * StringActionResult Constructor
     * @param null|string $text
     */
    public function __construct($text) {

        $this->text = $text;

    }

    /**
     * Render content
     */
    public function render() {

        echo $this->text;

    }

}