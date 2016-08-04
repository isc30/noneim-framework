<?php

/**
 * Cookie Service
 * @package Core
 * @subpackage Services
 */
class CookieService implements ICookieService
{
    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param null|int $expire
     * @param null|string $path
     * @param null|string $domain
     * @param null|bool $secure
     * @param null|bool $httpOnly
     */
    public function set($key, $value, $expire = null, $path = '/', $domain = null, $secure = null, $httpOnly = null)
    {
        if ($expire === null && defined('Configuration::defaultCookieExpiration'))
        {
            $expire = time() + Configuration::defaultCookieExpiration;
        }
        setcookie($key, $value, $expire, $path, $domain, $secure, $httpOnly);
        $_COOKIE[$key] = $value;
    }

    /**
     * @param string $key
     * @return null|mixed
     */
    public function get($key)
    {
        if ($this->exists($key))
        {
            return $_COOKIE[$key];
        }
        else
        {
            return null;
        }
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $_COOKIE;
    }

    /**
     * @param string $key
     * @param null|string $path
     * @param null|string $domain
     */
    public function delete($key, $path = '/', $domain = null)
    {
        $this->set($key, null, time() - 3600, $path, $domain);
        if (isset($_COOKIE[$key])) unset($_COOKIE[$key]);
    }
}