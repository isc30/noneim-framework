<?php

/**
 * CacheService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ICacheService extends IService
{
    /**
     * Return if loading cache is success.
     * If $object is ICacheable, call setCache() method. If not, leave the value in $object
     * @param string $area
     * @param string $name
     * @param object& $object
     * @return bool
     */
    public function load($area, $name, &$object);

    /**
     * Save cache
     * If $object is ICacheable, call getCache() method. If not, serialize $object content
     * @param string $area
     * @param string $name
     * @param object $object
     * @return
     */
    public function save($area, $name, $object);
}