<?php

/**
 * ClassFactory Interface
 * @package Core
 * @subpackage Interfaces
 */
interface IClassFactory extends IFactory {
    
    /**
     * Instantiate class from name
     * @param string $class Class name
     * @return object Class instance
     */
    public function instantiate($class);

    /**
     * Instantiate class from ReflectionClass
     * @param ReflectionClass $reflectionClass
     * @return object Class instance
     */
    public function instantiateReflectionClass(ReflectionClass $reflectionClass);

    /**
     * Instantiate class from name and call one method of it
     * @param string $class Class to instantiate
     * @param string $method Method to call
     * @param array $arguments
     * @return mixed Method return data
     * @throws InvalidParametersException
     */
    public function call($class, $method, array $arguments = array());

    /**
     * Instantiate class from name and call one method of it
     * @param IFrameworkRequest $request
     * @param string $controller
     * @param string $action
     * @param array $arguments
     * @return mixed Method return data
     * @throws InvalidParametersException
     */
    public function callControllerAction(IFrameworkRequest &$request, $controller, $action, array $arguments = array());
    
}