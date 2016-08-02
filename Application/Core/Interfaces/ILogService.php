<?php

/**
 * LogService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ILogService extends IService {

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