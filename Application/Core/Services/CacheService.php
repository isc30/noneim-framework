<?php

/**
 * Cache Service
 * @package Core
 * @subpackage Services
 */
class CacheService implements ICacheService {

    /** @var string */
    private $baseDir;

    /**
     * CacheService Constructor
     * @param null|string $baseDir
     */
    public function __construct($baseDir = null) {

        $this->baseDir = $baseDir !== null ? $baseDir : Configuration::applicationCachesDir;

    }

    /**
     * Return if loading cache is success
     * If $object is ICacheable, call setCache() method. If not, leave the value in $object
     * @param string $name
     * @param mixed $object
     * @return bool
     */
    public function load($name, &$object) {
        
        if (Configuration::caching) {
        
            try {
                
                $cacheFile = "{$this->baseDir}{$name}.cache";
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
     * @param string $name
     * @param mixed $object
     */
    public function save($name, &$object) {
        
        if (Configuration::caching) {
        
            $cacheFile = "{$this->baseDir}{$name}.cache";
            
            if ($object instanceof ICacheable)
            {
                $cache = $object->getCache();
            }
            else
            {
                $cache = serialize($object);
            }
            
            file_put_contents($cacheFile, $cache);
            
        }
        
    }
    
}