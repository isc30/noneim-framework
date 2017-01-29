<?php

interface IAuthenticationServiceBase extends IService
{
    /**
     * @return IModel // TODO: Change to custom type
     */
    public function get();

    /**
     * @param IModel $authentication // TODO: Change to custom type
     */
    public function set($authentication);

    /**
     */
    public function delete();
}