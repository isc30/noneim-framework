<?php

/**
 * Class Factory
 * @package Core
 * @subpackage Factories
 */
class ClassFactory implements IClassFactory {

    /** @var IInstallerContainer */
    private $_installerContainer;
        
    /**
     * Set InstallerContainer
     * @param IInstallerContainer $installerContainer
     */
    public function setInstallerContainer(IInstallerContainer $installerContainer) {
        
        $this->_installerContainer = $installerContainer;
        
    }

    /**
     * Instantiate class from name
     * @param string $class Class name
     * @return object Class instance
     */
    public function instantiate($class) {

        return $this->instantiateReflectionClass(new ReflectionClass($class));

    }

    /**
     * Instantiate class from ReflectionClass
     * @param ReflectionClass $reflectionClass
     * @return object Class instance
     */
    public function instantiateReflectionClass(ReflectionClass $reflectionClass) {

        $arguments = array();

        if ($reflectionClass->hasMethod('__construct')) {

            $constructor = $reflectionClass->getMethod('__construct');
            $constructorParameters = $constructor->getParameters();
            
            foreach ($constructorParameters as $parameter) {
                $parameterType = $parameter->getClass();
                if ($parameterType !== null) {
                    $parameterType = $parameterType->name;
                    $arguments[] = $this->_installerContainer->get($parameterType);
                }
            }

        }
        
        return $reflectionClass->newInstanceArgs($arguments);

    }

    /**
     * Instantiate class from name and call one method of it
     * @param string $class Class to instantiate
     * @param string $method Method to call
     * @param array $arguments
     * @return mixed Method return data
     * @throws InvalidParametersException
     */
    public function call($class, $method, array $arguments = array()) {

        $refectionClass = new ReflectionClass($class);
        $reflectionMethod = $refectionClass->getMethod($method);

        $instance = $this->instantiateReflectionClass($refectionClass);

        if (count($arguments) >= $reflectionMethod->getNumberOfRequiredParameters()) {

            if (!ArrayHelper::isAssociative($arguments)) {

                return $reflectionMethod->invokeArgs($instance, $arguments);

            } else {

                $parameters = $reflectionMethod->getParameters();
                foreach ($parameters as &$param) {

                    $name = (string)$param->getName();
                    $type = (string)$param->getType();

                    if ($type == 'IFrameworkRequest')
                    {
                        $param = $arguments['IFrameworkRequest'];
                    }
                    else
                    {
                        if (array_key_exists($name, $arguments) || $param->isOptional()) {

                            $param = array_key_exists($name, $arguments) ? $arguments[$name] : $param->getDefaultValue();

                        } else {

                            throw new InvalidParametersException("Parameter '{$name}' not found");

                        }
                    }

                }

                return $reflectionMethod->invokeArgs($instance, $parameters);

            }

        } else {

            $count = count($arguments);
            throw new InvalidParametersException("Missing parameters in call (got {$count} of {$reflectionMethod->getNumberOfRequiredParameters()})");

        }

    }

}