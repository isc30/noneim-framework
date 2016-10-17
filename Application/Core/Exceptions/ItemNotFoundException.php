<?php

/**
 * Item not found Exception
 * @package Core
 * @subpackage Exceptions
 */
class ItemNotFoundException extends Exception {

    /**
     * ItemNotFoundException Constructor
     * @param string $item
     */
    public function __construct($item = null) {

        parent::__construct("Item '{$item}' not found");

    }

}