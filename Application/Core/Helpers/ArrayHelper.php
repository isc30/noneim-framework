<?php

/**
 * Array Helper
 * @package Core
 * @subpackage Helpers
 */
class ArrayHelper implements IHelper {

    /**
     * No instanciable
     */
    private function __construct() {}

    /**
     * Return if array is associative
     * @param array $array
     * @return bool
     */
    public static function isAssociative(array &$array) {

        $keys = array_keys($array);
        sort($keys);

        return $keys !== range(0, count($array) - 1);
        
    }

    public static function getRandomKey(array &$array)
    {
        return array_rand($array);
    }

    public static function getRandomKeys(array &$array, $count)
    {
        $keys = array_rand($array, $count);
        if ($count === 1)
        {
            return array($keys);
        }
        else
        {
            return $keys;
        }
    }

    public static function getRandomValue(array &$array)
    {
        return $array[self::getRandomKey($array)];
    }

    public static function getRandomValues(array &$array, $count)
    {
        $keys = self::getRandomKeys($array, $count);
        $values = array();
        foreach ($keys as $key)
        {
            $values[] = $array[$key];
        }
        shuffle($values);
        return $values;
    }
    
}