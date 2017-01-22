<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 21/01/2017
 * Time: 23:33
 */
interface ILazyConfiguration extends IConfiguration
{
    /**
     * @return void
     */
    public static function configure();
}