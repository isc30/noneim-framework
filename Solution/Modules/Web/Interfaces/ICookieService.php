<?php

/**
 * CookieService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ICookieService extends IService
{
    /**
     * @param string $key
     * @return bool
     */
    public function exists($key);

    /**
     * @param string $key
     * @param null|mixed $value
     * @param null|int $expire
     * @param null|string $path
     * @param null|string $domain
     * @param null|bool $secure
     * @param null|bool $httpOnly
     */
    public function set($key, $value, $expire = null, $path = '/', $domain = null, $secure = null, $httpOnly = null);

    /**
     * @param string $key
     * @return null|mixed
     */
    public function get($key);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @param string $key
     * @param null|string $path
     * @param null|string $domain
     */
    public function delete($key, $path = '/', $domain = null);
}