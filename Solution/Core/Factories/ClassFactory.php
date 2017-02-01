<?php

/**
 * Class Factory
 */
class ClassFactory implements IClassFactory
{
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
    public function instantiateReflectionClass(ReflectionClass $reflectionClass)
    {
        $arguments = array();

        if ($reflectionClass->hasMethod('__construct'))
        {
            $constructor = $reflectionClass->getMethod('__construct');
            $constructorParameters = $constructor->getParameters();

            foreach ($constructorParameters as $key => $parameter)
            {
                $parameterType = $parameter->getClass()->name;

                if (RuntimeConfiguration::$debug && $parameter->isPassedByReference())
                {
                    echo "In class {{$reflectionClass->getName()}} please DON'T use reference injection<br/>";
                }

                $arguments[$key] = $this->_installerContainer->get($parameterType);
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
        return $this->callFromReflectionClass($refectionClass, $method, $arguments);

    }

    /**
     * Instantiate class from name and call one method of it
     * @param ReflectionClass $refectionClass
     * @param string $method Method to call
     * @param array $arguments
     * @return mixed Method return data
     * @throws InvalidParametersException
     */
    public function callFromReflectionClass(ReflectionClass $refectionClass, $method, array $arguments = array()) {

        $reflectionMethod = $refectionClass->getMethod($method);

        $instance = $this->instantiateReflectionClass($refectionClass);

        if (count($arguments) + 1 >= $reflectionMethod->getNumberOfRequiredParameters()) {

            $isAssociative = ArrayHelper::isAssociative($arguments);

            $index = 0;
            $parameters = $reflectionMethod->getParameters();

            foreach ($parameters as &$param)
            {
                $name = (string)$param->getName();
                if ($isAssociative)
                {
                    $argumentExists = array_key_exists($name, $arguments);

                    if ($argumentExists || $param->isOptional())
                    {
                        $param = $argumentExists ? $arguments[$name] : $param->getDefaultValue();
                    }
                    else
                    {
                        throw new InvalidParametersException("Parameter '{$name}' not found");
                    }
                }
                else
                {
                    $param = $arguments[$index++];
                }
            }

            return $reflectionMethod->invokeArgs($instance, $parameters);

        } else {

            $count = count($arguments);
            throw new InvalidParametersException("Missing parameters in call (got {$count} of {$reflectionMethod->getNumberOfRequiredParameters()})");

        }

    }

    /**
     * Instantiate class from name and call one method of it
     * @param IFrameworkRequest $request
     * @param string $controller
     * @param string $action
     * @param array $arguments
     * @return mixed Method return data
     * @throws InvalidParametersException
     */
    public function callControllerAction(IFrameworkRequest $request, $controller, $action, array $arguments = array())
    {
        $refectionClass = new ReflectionClass($controller);
        $reflectionMethod = $refectionClass->getMethod($action);

        $instance = $this->instantiateReflectionClass($refectionClass);

        $argumentCount = count($arguments);
        $requiredParameterCount = $reflectionMethod->getNumberOfRequiredParameters() - 1;

        if ($argumentCount >= $requiredParameterCount) {

            $isAssociative = ArrayHelper::isAssociative($arguments);
            $requestType = get_class($request);

            $index = 0;
            $parameters = $reflectionMethod->getParameters();

            foreach ($parameters as &$param)
            {
                $name = (string)$param->getName();
                $type = (string)(($class = $param->getClass()) !== null ? $class->getName() : null);

                if ($type === $requestType)
                {
                    $param = $request;
                }
                else
                {
                    if ($isAssociative)
                    {
                        $argumentExists = array_key_exists($name, $arguments);

                        if ($argumentExists || $param->isOptional())
                        {
                            $param = $argumentExists ? $arguments[$name] : $param->getDefaultValue();
                        }
                        else
                        {
                            throw new InvalidParametersException("Parameter '{$name}' not found");
                        }
                    }
                    else
                    {
                        $param = $arguments[$index++];
                    }
                }
            }

            return $reflectionMethod->invokeArgs($instance, $parameters);

        } else {

            throw new InvalidParametersException("Missing parameters in call (got {$argumentCount} of {$requiredParameterCount})");

        }

    }

    /**
     * Load Installer
     * @param string $className
     */
    public function loadInstaller($className)
    {
        $reflectionClass = new ReflectionClass($className);

        if (!RuntimeConfiguration::$debug || $reflectionClass->implementsInterface('IInstaller'))
        {
            $this->callFromReflectionClass($reflectionClass, 'install');
        }
    }
}