<?php

/**
 * Json ActionResult
 */
class JsonActionResult extends ActionResult
{
    /** @var string */
    private $_jsonString;

    /**
     * JsonActionResult Constructor
     * @param null|int|string|array|IModel $item
     */
    public function __construct($item)
    {
        $this->_jsonString = json_encode($item);
    }

    /**
     * Render content
     */
    public function render()
    {
        echo $this->_jsonString;
    }
}