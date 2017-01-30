<?php

/**
 * TestResult
 */
class TestResult implements IModel {

    /** @var string */
    public $name;
    /** @var double */
    public $time;
    /** @var bool */
    public $fullSuccess;
    /** @var TestMethod[] */
    public $methods;

}