<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 22/01/2017
 * Time: 2:11
 */
class CacheHelper
{
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
        if (!Configuration::caching)
        {
            return false;
        }

        try
        {
            $cacheFile = self::getCacheFile($area, $name);

            if (!file_exists($cacheFile))
            {
                return false;
            }

            $cache = file_get_contents($cacheFile);

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
        if (!Configuration::caching)
        {
            return false;
        }

        try
        {
            $cacheDir = getCacheDir($area);
            $cacheFile = self::getCacheFile($area, $name);

            if ($value instanceof ICacheable)
            {
                $cache = $value->getCache();
            }
            else
            {
                $cache = serialize($value);
            }

            // Folder creation
            if (!file_exists($cacheDir))
            {
                mkdir($cacheDir, 0664, true);
            }

            file_put_contents($cacheFile, $cache);
            chmod($cacheFile, 0664);

            return true;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    private static function getCacheDir($area)
    {
        return Configuration::cachesDir . "{$area}/";
    }

    private static function getCacheFile($area, $name)
    {
        return getCacheDir($area) . "{$name}." . Configuration::$project . '.cache';
    }
}