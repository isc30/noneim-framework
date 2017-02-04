<?php

/**
 * RequestService Interface
 */
interface IRequestService {

    /**
     * Return GET value of $key or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function get($key);

    /**
     * Return all GET values
     * @return mixed[]
     */
    public function allGet();

    /**
     * Return POST value of $key or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function post($key);

    /**
     * Return all POST values
     * @return mixed[]
     */
    public function allPost();

    /**
     * Return ANY value (POST and GET) of $key or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function any($key);

    /**
     * Return all values (POST and GET)
     * @return mixed[]
     */
    public function allAny();

}