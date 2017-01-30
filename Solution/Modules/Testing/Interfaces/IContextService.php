<?php

/**
 * ContextService Interface
 */
interface IContextService {

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