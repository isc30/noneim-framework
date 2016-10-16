<?php

/**
 * Authentication Service
 * @package Modules\Authentication
 * @subpackage Containers
 */
class AuthenticationService implements IService
{
    private $_sessionService;

    /** @var null|IAuthentication */
    private $authentication;

    /**
     * AuthenticationService Constructor
     * @param ISessionService $sessionService
     */
    public function __construct(ISessionService $sessionService)
    {
        $this->_sessionService = $sessionService;

        $this->authentication = null;
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }

    public function setAuthentication(IAuthentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function deleteAuthentication()
    {
        $this->authentication = null;
    }

    public function isAuthenticated()
    {
        return $this->authentication !== null;
    }
}