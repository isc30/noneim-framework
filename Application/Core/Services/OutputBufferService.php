<?php

/**
 * Output buffer Service
 * @package Core
 * @subpackage Services
 */
class OutputBufferService implements IOutputBufferService {

    /**
     * Start storing output to buffer
     * @param null|string $callback
     */
    public function start($callback = null) {
        
        if ($callback === null) {
            
            ob_start();
            
        } else {
            
            ob_start($callback);
            
        }
        
    }

    /**
     * Return buffer content
     * @return string
     */
    public function getContent() {
        
        return ob_get_contents();
        
    }

    /**
     * Print buffer content
     */
    public function flushContent() {
        
        flush();
        ob_flush();
        flush();
        
    }

    /**
     * Clean buffer content
     */
    public function clean() {
        
        ob_clean();
        
    }

    /**
     * End buffering
     */
    public function end() {
        
        ob_end_clean();
        
    }
    
}