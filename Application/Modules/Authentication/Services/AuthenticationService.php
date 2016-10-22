<?php

/**
 * Authentication Service
 * @package Modules\Authentication
 * @subpackage Containers
 */
abstract class AuthenticationService implements IAuthenticationServiceBase
{
    /** @var ISessionService */
    private $_sessionService;

    /**
     * AuthenticationService Constructor
     * @param ISessionService $sessionService
     */
    public function __construct(ISessionService $sessionService)
    {
        $this->_sessionService = $sessionService;
    }

    /**
     * return $this->_get();
     * @return null|IModel // TODO: Change IModel to native type
     */
    public abstract function get();

    /**
     * return $this->_set($authentication);
     * @param IModel $authentication // TODO: Change IModel to native type
     */
    public abstract function set($authentication);

    /**
     */
    public function delete()
    {
        $this->_sessionService->delete(AuthenticationConfiguration::sessionKey);
    }

    /**
     * @return null|IModel
     */
    protected function _get()
    {
        return $this->_sessionService->get(AuthenticationConfiguration::sessionKey);
    }

    /**
     * @param IModel $authentication
     */
    protected function _set($authentication)
    {
        $this->_sessionService->set(AuthenticationConfiguration::sessionKey, $authentication);
    }
}