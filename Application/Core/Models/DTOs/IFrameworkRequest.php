<?php

/**
 * Created by PhpStorm.
 * User: isc
 * Date: 8/4/16
 * Time: 1:54 PM
 */
class IFrameworkRequest
{
    public $section;
    public $parameters;
}

class IFrameworkRequestParameters
{
    private $get;
    private $post;

    public function __construct($get, $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function existsGet($key)
    {
        return isset($this->get[$key]);
    }

    public function get($key)
    {
        if (!$this->existsGet($key)) return null;
        return $this->get[$key];
    }

    public function existsPost($key)
    {
        return isset($this->post[$key]);
    }

    public function post($key)
    {
        if (!$this->existsPost($key)) return null;
        return $this->post[$key];
    }

    public function exists($key)
    {
        return $this->existsGet($key) || $this->existsPost($key);
    }

    public function any($key)
    {
        if ($this->existsPost($key))
        {
            return $this->post($key);
        }
        else
        {
            if ($this->existsGet($key))
            {
                return $this->get($key);
            }
            else
            {
                return null;
            }
        }
    }
}