<?php

/**
 * UUID
 * @package Core
 * @subpackage Models\BusinessObjects
 */
class UUID implements IModel {
    
    /** @var string */
    private $uuid;
    
    /**
     * UUID Constructor
     */
    public function __construct() {
        
        $this->uuid = uniqid(rand());
        
    }
    
    /**
     * Return string value
     */
    public function __toString() {
        
        return $this->uuid;
        
    }
    
}