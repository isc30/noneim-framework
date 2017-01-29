<?php

class ExceptionDemoController implements IController
{
    public function index()
    {
        throw new Exception("WTF xD This is broken, dude...");
    }
}