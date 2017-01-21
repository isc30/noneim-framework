<?php

/**
 * OutputBufferService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface IOutputBufferService extends IService {

    /**
     * Start storing output to buffer
     * @param null|string $callback
     */
    public function start($callback = null);

    /**
     * Return buffer content
     * @return string
     */
    public function getContent();

    /**
     * Print buffer content
     */
    public function flushContent();

    /**
     * Clean buffer content
     */
    public function clean();

    /**
     * End buffering
     */
    public function end();

}