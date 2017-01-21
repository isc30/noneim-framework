<?php

/**
 * Json ActionResult
 * @package Core
 * @subpackage Models\ActionResults
 */
class JsonActionResult implements IActionResult {

    /** @var string */
    private $jsonString;

    /**
     * JsonActionResult Constructor
     * @param null|array|IModel $item
     */
    public function __construct($item) {

        $this->jsonString = json_encode($item);

    }

    /**
     * Render content
     */
    public function render() {

        echo $this->jsonString;

    }

}