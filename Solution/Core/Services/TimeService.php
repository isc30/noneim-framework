<?php

class TimeService implements ITimeService {
    
    /**
     * Return current Microtime
     * @return float
     */
    public function microtime() {

        return microtime(true);

    }

    /**
     * Return current Timestamp
     * @return int
     */
    public function timestamp() {

        return time();

    }

    /**
     * Return current DateTime
     * @param string $format
     * @return string
     */
    public function datetime($format = 'Y-m-d H:i:s') {

        return date($format, $this->timestamp());

    }

}