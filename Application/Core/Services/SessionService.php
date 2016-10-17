<?php

/**
 * Session Service
 * @package Core
 * @subpackage Services
 */
class SessionService implements ISessionService {

    /** @var bool */
    private $started;

    /**
     * SessionService Constructor
     */
    public function __construct() {

        $this->started = false;

    }

    /**
     * Start session
     */
    public function start() {
        
        if ($this->started) return;
        
        session_start();
        $this->started = true;
        
    }

    /**
     * Destroy session
     */
    public function destroy() {
        
        $this->start();
        session_destroy();
        $this->started = false;
        $this->regenerateId(true);
        
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        $this->start();
        return isset($_SESSION[$key]);
    }

    /**
     * Return session id
     * @return string
     */
    public function getId() {
        
        $this->start();
        return session_id();
        
    }

    /**
     * Set session id
     * @param string $id
     */
    public function setId($id) {
        
        $this->start();
        session_id($id);
        
    }

    /**
     * Regenerate id of current session
     * @param bool $deleteSession Remove session data?
     */
    public function regenerateId($deleteSession = false) {
        
        $this->start();
        session_regenerate_id($deleteSession);
        
    }

    /**
     * Delete $key in session
     * @param string $key
     */
    public function delete($key) {

        $this->start();
        unset($_SESSION[$key]);

    }

    /**
     * Delete all keys in session
     */
    public function deleteAll() {

        $this->start();
        $_SESSION = array();

    }

    /**
     * Return value from $key in session or null if not exists
     * @param string $key
     * @return null|string
     */
    public function get($key) {
        
        $this->start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        
    }

    /**
     * Return all session key => value
     * @return mixed[]
     */
    public function getAll() {
        
        $this->start();
        return $_SESSION;
        
    }

    /**
     * Set value for $key in session
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value) {
        
        $this->start();
        $_SESSION[$key] = $value;
        
    }
}