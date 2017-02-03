<?php

/**
 * Cache Helper
 */
class CacheHelper implements IHelper
{
    /**
     * No instantiable
     */
    private function __construct()
    {
    }

    /**
     * Return if loading cache is success
     * If $object is ICacheable, call setCache() method. If not, leave the value in $object
     * @param string $area
     * @param string $name
     * @param object|array &$value
     * @return bool
     */
    public static function load($area, $name, &$value)
    {
        if (!RuntimeConfiguration::$cache)
        {
            return false;
        }

        try
        {
            $cacheDir = self::getCacheDir($area);
            $cacheFileName = self::getCacheFileName($name);
            $cachePath = $cacheDir . $cacheFileName;

            if (!file_exists($cachePath))
            {
                return false;
            }

            $cache = file_get_contents($cachePath);

            if ($value instanceof ICacheable)
            {
                $value->setCache($cache);
            }
            else
            {
                $value = unserialize($cache);
            }

            return true;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    /**
     * Save cache
     * If $object is ICacheable, call getCache() method. If not, serialize $object content
     * @param string $area
     * @param string $name
     * @param object|array $value
     * @return bool
     */
    public static function save($area, $name, $value)
    {
        if (!RuntimeConfiguration::$cache)
        {
            return false;
        }

        try
        {
            $cacheDir = self::getCacheDir($area);
            $cacheFileName = self::getCacheFileName($name);
            $cachePath = $cacheDir . $cacheFileName;

            if ($value instanceof ICacheable)
            {
                $cache = $value->getCache();
            }
            else
            {
                $cache = serialize($value);
            }

            static $permissionCode = 0774;

            $oldmask = umask(0); // Avoid readonly folder

            // Create folder if not exists
            if (!file_exists($cacheDir))
            {
                mkdir($cacheDir, $permissionCode, true);
                chmod($cacheDir, $permissionCode);
            }

            // Create file
            file_put_contents($cachePath, $cache);
            chmod($cachePath, $permissionCode);

            umask($oldmask); // Restore default configuration

            return true;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    /**
     * Get directory of cache area
     * @param string $area
     * @return string
     */
    private static function getCacheDir($area)
    {
        return SolutionConfiguration::$cachesDir . "{$area}/";
    }

    /**
     * Get cache file name
     * @param string $name
     * @return string
     */
    private static function getCacheFileName($name)
    {
        return "{$name}." . SolutionConfiguration::$project . '.tmp';
    }
}