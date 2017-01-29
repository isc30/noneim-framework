<?php

class ValidationHelper implements IHelper
{
    /**
     * No instantiable
     */
    private function __construct()
    {
    }

    /**
     * Test if $value is email
     * @param string $value
     * @return bool
     */
    public static function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Test if $buffer is HTML
     * @param string $buffer
     * @return bool
     */
    public static function isHtml($buffer)
    {
        return substr(trim($buffer), 0, 2) === '<!';
    }

    /**
     * Test if $buffer is JSON
     * @param string $buffer
     * @return bool
     */
    public static function isJson($buffer)
    {
        json_decode($buffer);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Test if $input is null or empty
     * @param null|string|array $input
     * @return bool
     */
    public static function isNullOrEmpty($input)
    {
        if (is_string($input))
        {
            return $input === null || strlen($input) === 0;
        }
        else
        {
            return $input === null || count($input) === 0;
        }
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
     * Test if all values in $inputArray are not null or empty
     * @param mixed[] $inputArray Input array
     * @return bool
     */
    public static function testInput(array $inputArray)
    {
        foreach ($inputArray as $input)
        {
            if (self::isNullOrEmpty($input))
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Return all names whose value is null or empty
     * @param mixed[] $inputArray Input array (name => value)
     * @return string[]
     */
    public static function testInputWithName(array $inputArray)
    {
        $failedInputs = array();

        foreach ($inputArray as $name => $value)
        {
            if (self::isNullOrEmpty($value))
            {
                $failedInputs[] = $name;
            }
        }

        return $failedInputs;
    }
}