<?php

interface IHeaderService extends IService {
    
    /**
     * Return Request Header
     * @param string $header
     * @return null|string
     */
    public function get($header);
    
    /**
     * Return all Request Headers (key => value)
     * @return string[]
     */
    public function getAll();
    
    /**
     * Return Outgoing Header
     * @param string $header
     * @return null|string
     */
    public function getOutgoing($header);
    
    /**
     * Return all Outgoing Headers (header => value)
     * @return string[]
     */
    public function getAllOutgoing();
    
    /**
     * Set Outgoing Header
     * @param string $header
     * @param string $value
     */
    public function set($header, $value);

    /**
     * Set Outgoing Response Code
     * @param int $code
     */
    public function setResponseCode($code);
    
    /**
     * Restore all headers
     * @param string[] $originalHeaders Original headers (header => value)
     */
    public function restoreHeaders(array $originalHeaders);
    
}