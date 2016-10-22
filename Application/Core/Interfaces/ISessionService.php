<?php

/**
 * SessionService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ISessionService extends IService {

    /**
     * Start session
     */
    public function start();

    /**
     * Destroy session
     */
    public function destroy();

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key);

    /**
     * Return session id
     * @return string
     */
    public function getId();

    /**
     * Set session id
     * @param string $id
     */
    public function setId($id);

    /**
     * Regenerate id of current session
     */
    public function regenerateId();

    /**
     * Delete $key in session
     * @param string $key
     */
    public function delete($key);

    /**
     * Delete all keys in session
     */
    public function deleteAll();

    /**
     * Return value from $key in session or null if not exists
     * @param string $key
     * @return null|mixed
     */
    public function get($key);

    /**
     * Return all session key => value
     * @return mixed[]
     */
    public function getAll();

    /**
     * Set value for $key in session
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value);

}