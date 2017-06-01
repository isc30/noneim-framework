<?php

/**
 * Reflection Helper
 */
class ReflectionHelper extends StaticClass
{
    /** @var ClassDefinition[] */
    private static $_solutionClasses = null;

    /**
     * @return ClassDefinition[]
     */
    public static function getSolutionClasses()
    {
        if (self::$_solutionClasses !== null)
        {
            return self::$_solutionClasses; // Already filled
        }

        if (!CacheHelper::load('Core', 'ReflectionHelper.SolutionClasses', self::$_solutionClasses))
        {
            self::fillSolutionClasses();

            CacheHelper::save('Core', 'ReflectionHelper.SolutionClasses', self::$_solutionClasses);
        }

        return self::$_solutionClasses;
    }

    /**
     * GetImplementations Cache
     * @var ClassDefinition[][]
     */
    private static $_getImplementations = array();

    /**
     * Find Implementations of given Interface
     * @param string $interfaceName
     * @return ClassDefinition[]
     */
    public static function getImplementations($interfaceName)
    {
        if (isset(self::$_getImplementations[$interfaceName]))
        {
            return self::$_getImplementations[$interfaceName];
        }

        if (!CacheHelper::load('Core', 'ReflectionHelper.GetImplementations', self::$_getImplementations[$interfaceName], $interfaceName))
        {
            self::$_getImplementations[$interfaceName] = self::_getImplementations($interfaceName);

            CacheHelper::save('Core', 'ReflectionHelper.GetImplementations', self::$_getImplementations[$interfaceName], $interfaceName);
        }

        return self::$_getImplementations[$interfaceName];
    }

    /**
     * Find Implementations of given Interface
     * @param string $interfaceName
     * @return string[]
     */
    private static function _getImplementations($interfaceName)
    {
        $classNames = array();

        foreach (self::getSolutionClasses() as $class => $definition)
        {
            $rc = new ReflectionClass($definition->name);

            if (!$rc->isInterface() && $rc->implementsInterface($interfaceName))
            {
                $classNames[] = $definition;
            }
        }

        return $classNames;
    }

    /**
     * GetSubclasses Cache
     * @var ClassDefinition[][]
     */
    private static $_getSubclasses = array();

    /**
     * Find Subclasses of given Class
     * @param string $className
     * @return ClassDefinition[]
     */
    public static function getSubclasses($className)
    {
        if (isset(self::$_getSubclasses[$className]))
        {
            return self::$_getSubclasses[$className];
        }

        if (!CacheHelper::load('Core', 'ReflectionHelper.GetSubclasses', self::$_getSubclasses[$className], $className))
        {
            self::$_getSubclasses[$className] = self::_getSubclasses($className);

            CacheHelper::save('Core', 'ReflectionHelper.GetSubclasses', self::$_getSubclasses[$className], $className);
        }

        return self::$_getSubclasses[$className];
    }

    /**
     * Find Subclasses of given Class
     * @param string $className
     * @return string[]
     */
    private static function _getSubclasses($className)
    {
        $classNames = array();

        foreach (self::getSolutionClasses() as $class => $definition)
        {
            $rc = new ReflectionClass($definition->name);

            if (!$rc->isAbstract() && $rc->isSubclassOf($className))
            {
                $classNames[] = $definition;
            }
        }

        return $classNames;
    }

    /**
     * Iterate all dirs inside Solution and get a list of classes available
     */
    private static function fillSolutionClasses()
    {
        self::$_solutionClasses = array();

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(SolutionConfiguration::$solutionDir));

        foreach ($iterator as $file)
        {
            if ($file->isFile())
            {
                $path = $file->getPathname();
                $extension = $file->getExtension();

                if ($extension === 'php')
                {
                    $declarations = self::getFileDeclarations($path);

                    foreach ($declarations as $declaration)
                    {
                        $classDefinition = new ClassDefinition();
                        $classDefinition->name = $declaration;
                        $classDefinition->path = $path;

                        self::$_solutionClasses[$declaration] = $classDefinition;
                    }
                }
            }
        }
    }

    /**
     * Scan source code looking for declarations
     * @param string $file
     * @return string[]
     */
    private static function getFileDeclarations($file)
    {
        $declarations = [];

        $tokens = token_get_all(file_get_contents($file));

        $currentNamespace = "";
        $waitingDeclarationName = false;
        $waitingNamespace = false;

        foreach ($tokens as $token)
        {
            if (is_array($token))
            {
                $tokenName = token_name($token[0]);

                if ($tokenName === 'T_CLASS' || $tokenName === 'T_INTERFACE' || $tokenName === 'T_TRAIT')
                {
                    $waitingDeclarationName = true;

                    if ($waitingNamespace)
                    {
                        $currentNamespace = "";
                        $waitingNamespace = false;
                    }
                }
                elseif ($tokenName === 'T_NAMESPACE')
                {
                    $waitingNamespace = true;
                    $waitingDeclarationName = false;
                }
                elseif ($tokenName === 'T_STRING')
                {
                    if ($waitingDeclarationName)
                    {
                        $declarations[] = $currentNamespace !== "" ? "{$currentNamespace}\\{$token[1]}" : $token[1];
                        $waitingDeclarationName = false;
                    }
                    elseif ($waitingNamespace)
                    {
                        $currentNamespace = $token[1];
                        $waitingNamespace = false;
                    }
                }
                elseif ($tokenName !== 'T_WHITESPACE')
                {
                    if ($waitingNamespace)
                    {
                        $currentNamespace = "";
                        $waitingNamespace = false;
                    }
                }
            }
        }

        return $declarations;
    }
}