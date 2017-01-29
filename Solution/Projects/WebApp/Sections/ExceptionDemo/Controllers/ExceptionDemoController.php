<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 26/01/2017
 * Time: 18:51
 */
class ExceptionDemoController implements IController
{
    public function index()
    {
        throw new Exception("WTF xD This is broken, dude...");
    }
}