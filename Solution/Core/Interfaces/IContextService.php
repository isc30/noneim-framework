<?php

/**
 * ContextService Interface
 * @package Core
 * @subpackage Interfaces
 */
interface IContextService extends IService {

    /**
     * Return current Context
     * @return Context
     */
    public function get();
    
    /**
     * Set current Context
     * @param Context $context
     * @return
     */
    public function set(Context $context);

}