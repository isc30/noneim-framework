<?php

/**
 * TimeService Interface
 */
interface ITimeService {

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