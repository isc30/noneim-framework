<?php

/**
 * Cache Service
 * @package Core
 * @subpackage Services
 */
class CacheService implements ICacheService
{
    /**
     * CacheService Constructor
     */
    public function __construct()
    {
    }

    /**
     * Return if loading cache is success
     * If $object is ICacheable, call setCache() method. If not, leave the value in $object
     * @param string $area
     * @param string $name
     * @param object& $object
     * @return bool
     */
    public function load($area, $name, &$object) {
        
        if (Configuration::caching) {
        
            try {
                
                $cacheFile = Configuration::cachesDir . "{$area}/{$name}.cache";

                if (file_exists($cacheFile)) {
                    
                    $cache = file_get_contents($cacheFile);
                    if ($object instanceof ICacheable) {
                        $object->setCache($cache);
                    } else {
                        $object = unserialize($cache);
                    }
                    
                    return true;
                    
                }
                
            } catch (Exception $ex) {}
            
        }
            
        return false;
        
    }

    /**
     * Save cache
     * If $object is ICacheable, call getCache() method. If not, serialize $object content
     * @param string $area
     * @param string $name
     * @param object $object
     */
    public function save($area, $name, $object) {
        
        if (Configuration::caching) {

            $cacheFile = Configuration::cachesDir . "{$area}/{$name}.cache";
            
            if ($object instanceof ICacheable)
            {
                $cache = $object->getCache();
            }
            else
            {
                $cache = serialize($object);
            }
            
            file_put_contents($cacheFile, $cache);
            chmod($cacheFile, 0664);
            
        }
        
    }
    
}