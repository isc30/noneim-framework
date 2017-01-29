<?php

/**
 * LogService Interface
 */
interface ILogService {

    /**
     * Add item to Item Collection
     * @param $item
     */
    public function log($item);

    /**
     * Print content of Item Collection
     */
    public function flush();
    
}