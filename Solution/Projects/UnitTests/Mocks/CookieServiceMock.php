<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 22/01/2017
 * Time: 1:26
 */
class CookieServiceMock implements ICookieService
{
    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        // TODO: Implement exists() method.
    }

    /**
     * @param string $key
     * @param null|mixed $value
     * @param null|int $expire
     * @param null|string $path
     * @param null|string $domain
     * @param null|bool $secure
     * @param null|bool $httpOnly
     */
    public function set($key, $value, $expire = null, $path = '/', $domain = null, $secure = null, $httpOnly = null)
    {
        // TODO: Implement set() method.
    }

    /**
     * @param string $key
     * @return null|mixed
     */
    public function get($key)
    {
        // TODO: Implement get() method.
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return "ajajaja";
    }

    /**
     * @param string $key
     * @param null|string $path
     * @param null|string $domain
     */
    public function delete($key, $path = '/', $domain = null)
    {
        // TODO: Implement delete() method.
    }
}