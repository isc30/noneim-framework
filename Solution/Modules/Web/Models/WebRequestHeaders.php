<?php

/**
 * WebRequest Headers
 */
class WebRequestHeaders
{
    /**  @var string[] */
    private $_headers;

    /**
     * WebRequestHeaders Constructor
     * @param string[] $header
     */
    public function __construct($header)
    {
        $this->_headers = $header;
    }

    /**
     * @param string $header
     * @return bool
     */
    public function exists($header)
    {
        return isset($this->_headers[$header]);
    }

    /**
     * @param $header
     * @return null|string
     */
    public function get($header)
    {
        if ($this->exists($header))
        {
            return $this->_headers[$header];
        }

        return null;
    }
}