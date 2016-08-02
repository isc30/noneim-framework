<?php

/**
 * CacheService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ICacheService extends IService {

    /**
     * Return if loading cache is success.
     * If $object is ICacheable, call setCache() method. If not, leave the value in $object
     * @param string $name
     * @param mixed $object
     * @return bool
     */
    public function load($name, &$object);
    /**
     * Save cache
     * If $object is ICacheable, call getCache() method. If not, serialize $object content
     * @param string $name
     * @param mixed $object
     */
    public function save($name, &$object);
    
}