<?php

/**
 * Cacheable Interface
 */
interface ICacheable {
    
    /**
     * Get Cache
     * @return string
     */
    public function getCache();
    
    /**
     * Set Cache
     * @param string $cache
     */
    public function setCache($cache);
    
}