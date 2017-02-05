<?php

/**
 * String Helper
 */
class StringHelper extends StaticClass
{
    /**
     * Test if $string is empty
     * @param string $string
     * @return bool
     */
    public static function isEmpty($string)
    {
        return strlen($string) === 0;
    }

    /**
     * Test if $string is null or empty
     * @param null|string $string
     * @return bool
     */
    public static function isNullOrEmpty($string)
    {
        return $string === null || self::isEmpty($string);
    }

    /**
     * Test if $string starts with $start
     * @param string $string
     * @param string $start
     * @return bool
     */
    public static function startsWith($string, $start)
    {
        return substr($string, 0, strlen($start)) === $start;
    }

    /**
     * Test if $string ends with $end
     * @param string $string
     * @param string $end
     * @return bool
     */
    public static function endsWith($string, $end)
    {
        return substr($string, -strlen($end)) === $end;
    }

    /**
     * Return the input string with the first letter as uppercase
     * @param string $string
     * @return string
     */
    public static function firstUppercase($string)
    {
        if (!self::isEmpty($string))
        {
            $string[0] = strtoupper($string[0]);
        }

        return $string;
    }
}