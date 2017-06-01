<?php

/**
 * Exception Demo Controller
 */
class ExceptionDemoController extends Controller
{
    public function index()
    {
        throw new Exception("WTF xD This is broken, dude...");
    }
}