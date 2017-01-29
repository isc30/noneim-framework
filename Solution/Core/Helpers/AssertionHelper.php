<?php

class AssertionHelper implements IHelper {

    /**
     * No instantiable
     */
    private function __construct() {}

    /**
     * Test assertion
     * @param bool $assertion Assertion to be tested
     * @throws AssertionFailedException If assertion fails
     */
    public static function assert($assertion) {
        if ($assertion !== true) {
            throw new AssertionFailedException();
        }
    }

    /**
     * Test if value is true
     * @param bool $v0
     * @throws AssertionFailedException If value is not true
     */
    public static function isTrue($v0) {
        self::assert($v0 === true);
    }

    /**
     * Test if value is false
     * @param bool $v0
     * @throws AssertionFailedException If value is not false
     */
    public static function isFalse($v0) {
        self::assert($v0 === false);
    }

    /**
     * Test if values are equal
     * @param mixed $v0
     * @param mixed $v1
     * @throws AssertionFailedException If values are not equal
     */
    public static function isEqual($v0, $v1) {
        self::assert($v0 === $v1);
    }

    /**
     * Test if values are not equal
     * @param mixed $v0
     * @param mixed $v1
     * @throws AssertionFailedException If values are equal
     */
    public static function isNotEqual($v0, $v1) {
        self::assert($v0 !== $v1);
    }

    /**
     * Test if value is null
     * @param mixed $v0
     * @throws AssertionFailedException If value is not null
     */
    public static function isNull($v0) {
        self::assert($v0 === null);
    }

    /**
     * Test if value is not null
     * @param mixed $v0
     * @throws AssertionFailedException If value is null
     */
    public static function isNotNull($v0) {
        self::assert($v0 !== null);
    }

    /**
     * Test if value is null or empty
     * @param null|string|array $v0
     * @throws AssertionFailedException If value is not null or empty
     */
    public static function isNullOrEmpty($v0) {

        if (is_string($v0)) {
            self::assert($v0 === null || strlen($v0) === 0);
        } else {
            self::assert($v0 === null || count($v0) === 0);
        }

    }

    /**
     * Test if value is not null or empty
     * @param null|string|array $v0
     * @throws AssertionFailedException If value is null or empty
     */
    public static function isNotNullOrEmpty($v0) {

        if (is_string($v0)) {
            self::assert($v0 !== null && strlen($v0) > 0);
        } else {
            self::assert($v0 !== null && count($v0) > 0);
        }

    }

    /**
     * Test if $v0 is greater than $v1
     * @param number $v0
     * @param number $v1
     * @throws AssertionFailedException If $v0 is not greater than $v1
     */
    public static function isGt($v0, $v1) {
        self::assert($v0 > $v1);
    }

    /**
     * Test if $v0 is greater or equal than $v1
     * @param number $v0
     * @param number $v1
     * @throws AssertionFailedException If $v0 is not greater or equal than $v1
     */
    public static function isGe($v0, $v1) {
        self::assert($v0 >= $v1);
    }

    /**
     * Test if $v0 is less than $v1
     * @param number $v0
     * @param number $v1
     * @throws AssertionFailedException If $v0 is not less than $v1
     */
    public static function isLt($v0, $v1) {
        self::assert($v0 < $v1);
    }

    /**
     * Test if $v0 is less or equal than $v1
     * @param number $v0
     * @param number $v1
     * @throws AssertionFailedException If $v0 is not less or equal than $v1
     */
    public static function isLe($v0, $v1) {
        self::assert($v0 <= $v1);
    }

    /**
     * Test if $v0 is defined
     * @param mixed $v0
     * @throws AssertionFailedException If $v0 is not defined
     */
    public static function exists(&$v0) {
        self::assert(isset($v0));
    }

    /**
     * Test if $v0 is not defined
     * @param mixed $v0
     * @throws AssertionFailedException If $v0 is defined
     */
    public static function notExists(&$v0) {
        self::assert(!isset($v0));
    }

}