<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 17/10/2016
 * Time: 21:13
 */
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