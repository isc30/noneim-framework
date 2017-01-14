<?php

/**
 * TimeService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ITimeService extends IService {

    /**
     * Return current Microtime
     * @return float
     */
    public function microtime();

    /**
     * Return current Timestamp
     * @return int
     */
    public function timestamp();

    /**
     * Return current DateTime
     * @return string
     */
    public function datetime();

}