<?php

/**
 * IFrameworkRequest Parameters
 */
class IFrameworkRequestParameters
{
    /** @var string[] */
    private $_get;
    /** @var string[] */
    private $post;

    /**
     * IFrameworkRequestParameters Constructor
     * @param string[] $get
     * @param string[] $post
     */
    public function __construct($get, $post)
    {
        $this->_get = $get;
        $this->post = $post;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function existsGet($key)
    {
        return isset($this->_get[$key]);
    }

    /**
     * @param string $key
     * @return null|string
     */
    public function get($key)
    {
        if ($this->existsGet($key))
        {
            return $this->_get[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function existsPost($key)
    {
        return isset($this->post[$key]);
    }

    /**
     * @param string $key
     * @return null|string
     */
    public function post($key)
    {
        if ($this->existsPost($key))
        {
            return $this->post[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return $this->existsGet($key) || $this->existsPost($key);
    }

    /**
     * @param string $key
     * @return null|string
     */
    public function any($key)
    {
        if ($this->existsPost($key))
        {
            return $this->post($key);
        }
        elseif ($this->existsGet($key))
        {
            return $this->get($key);
        }

        return null;
    }
}