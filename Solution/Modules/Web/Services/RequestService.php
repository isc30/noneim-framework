<?php

/**
 * Request Service
 * @package Core
 * @subpackage Services
 */
class RequestService implements IRequestService {

    /**
     * Return GET value of $key or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function get($key) {

        return (isset($_GET[$key])) ? $_GET[$key] : null;

    }

    /**
     * Return all GET values
     * @return mixed[]
     */
    public function allGet() {

        return $_GET;

    }

    /**
     * Return POST value of $key or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function post($key) {

        return (isset($_POST[$key])) ? $_POST[$key] : null;

    }

    /**
     * Return all POST values
     * @return mixed[]
     */
    public function allPost() {

        return $_POST;

    }

    /**
     * Return ANY value (POST and GET) of $key or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function any($key) {

        return (isset($_REQUEST[$key])
            ? $_REQUEST[$key]
            : (isset($_GET[$key])
                ? $_GET[$key]
                : (isset($_POST[$key])
                    ? $_POST[$key]
                    : null)));

    }

    /**
     * Return all values (POST and GET)
     * @return mixed[]
     */
    public function allAny() {

        return $_REQUEST;

    }

}