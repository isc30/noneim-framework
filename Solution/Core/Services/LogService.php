<?php

/**
 * Log Service
 * @package Core
 * @subpackage Services
 */
class LogService implements ILogService {
    
    /** @var array[] */
    private $itemCollection;

    /**
     * LogService Constructor
     */
    public function __construct() {
        $this->itemCollection = array();
    }

    /**
     * Add item to Item Collection
     * @param string $message
     * @param string $css
     */
    public function log($message, $css = '') {
        
        $this->itemCollection[] = array(
            'text' => $message,
            'css' => $css
        );
        
    }

    /**
     * Print content of Item Collection
     */
    public function flush() {
        
        echo '<script>';
        foreach ($this->itemCollection as $item) {
            echo "console.log('%c{$item['text']}', '{$item['css']}');";
        }
        echo '</script>';
        
    }

}