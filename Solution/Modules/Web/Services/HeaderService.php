<?php

class HeaderService implements IHeaderService {

    /**
     * HeaderService Constructor
     */
    public function __construct() {

        $this->set('Imasi-Created-With', 'IFramework v' . CoreConfiguration::$version);
        $this->set('Imasi-Core-Loaded-In', IFramework::$coreLoadTime . 'ms');

    }

    /**
     * Return Request Header
     * @param string $header
     * @return null|string
     */
    public function get($header) {
        
        // RFC3875, 4.1.18
        $name = 'HTTP_' . str_replace('-', '_', strtoupper($header));
        return isset($_SERVER[$name]) ? $_SERVER[$name] : null;
        
    }
    
    /**
     * Return all Request Headers (key => value)
     * @return string[]
     */
    public function getAll() {
        
        $headers = array();
        
        foreach ($_SERVER as $key => $value) {
            
            if (substr($key, 0, 5) === "HTTP_") {
                
                // RFC3875, 4.1.18
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))));
                $headers[$key] = $value;
                
            } else {   
                
                $headers[$key] = $value;
                
            }
            
        }
        
        return $headers;
        
    }
    
    /**
     * Return Outgoing Header
     * @param string $header
     * @return null|string
     */
    public function getOutgoing($header) {
        
        $headers = headers_list();
    
        foreach ($headers as $header) {
            $data = explode(':', $header);
            if (trim($data[0]) === $header) {
                return trim($data[1]);
            }
        }
        
        return null;
        
    }
    
    /**
     * Return all Outgoing Headers (header => value)
     * @return string[]
     */
    public function getAllOutgoing() {

        $result = array();
        $headers = headers_list();
    
        foreach ($headers as $header) {
            $data = explode(':', $header);
            $result[trim($data[0])] = trim($data[1]);
        }
    
        return $result;
        
    }
    
    /**
     * Set Outgoing Header
     * @param string $header
     * @param string $value
     */
    public function set($header, $value) {
        
        header("{$header}:{$value}");
        
    }

    /**
     * Set Outgoing Response Code
     * @param int $code
     */
    public function setResponseCode($code) {

        $message = ' ';
        $messages = array(
            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',

            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',

            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',  // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            // 306 is deprecated but reserved
            307 => 'Temporary Redirect',

            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',

            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            509 => 'Bandwidth Limit Exceeded'
        );

        if (isset($messages[$code])) {
            $message = $messages[$code];
        }

        header($message, true, $code);

    }
    
    /**
     * Restore all headers
     * @param string[] $originalHeaders Original headers (header => value)
     */
    public function restoreHeaders(array $originalHeaders) {

        $currentHeaders = $this->getAllOutgoing();

        foreach ($currentHeaders as $header => $value) {
            $this->set($header, null);
        }

        foreach ($originalHeaders as $header => $value) {
            $this->set($header, $value);
        }

    }

}