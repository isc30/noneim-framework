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
    public static function isAssociative(array $array) {

        $keys = array_keys($array);
        sort($keys);

        return $keys !== range(0, count($array) - 1);
        
    }
    
}