<?php

/**
 * Context Service
 * @package Core
 * @subpackage Services
 */
class ContextService implements IContextService {

    /** @var ITimeService */
    private $_timeService;
    /** @var ISessionService */
    private $_sessionService;
    /** @var IHeaderService */
    private $_headerService;

    /**
     * ContextService constructor
     * @param ITimeService $timeService
     * @param ISessionService $sessionService
     * @param IHeaderService $headerService
     */
    public function __construct(
        ITimeService $timeService,
        ISessionService $sessionService,
        IHeaderService $headerService
    ) {
        $this->_timeService = $timeService;
        $this->_sessionService = $sessionService;
        $this->_headerService = $headerService;
    }

    /**
     * Return current Context
     * @return Context
     */
    public function get() {

        $context = new Context();
        $context->time = $this->_timeService->microtime();
        $context->sessionId = $this->_sessionService->getId();
        $context->session = $this->_sessionService->getAll();
        $context->get = $_GET;
        $context->post = $_POST;
        $context->request = $_REQUEST;
        $context->headers = $this->_headerService->getAllOutgoing();

        return $context;

    }
    
    /**
     * Set current Context
     * @param Context $context
     */
    public function set(Context $context) {
        
        $this->_headerService->restoreHeaders($context->headers);
        $_GET = $context->get;
        $_POST = $context->post;
        $_REQUEST = $context->request;
        
        $this->_sessionService->deleteAll();
        $this->_sessionService->setId($context->sessionId);
        foreach ($context->session as $key => $value) {
            $this->_sessionService->set($key, $value);
        }
    
    }

}