<?php

/**
 * Reflection Helper
 */
class ReflectionHelper implements IHelper
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
     * @param string $interfaceName
     * @return ClassDefinition[]
     */
    public static function getImplementations($interfaceName)
    {
        if (isset(self::$_getImplementations[$interfaceName]))
        {
            return self::$_getImplementations[$interfaceName];
        }

        if (!CacheHelper::load('Core', "ReflectionHelper.GetImplementations.{$interfaceName}", self::$_getImplementations[$interfaceName]))
        {
            self::$_getImplementations[$interfaceName] = self::_getImplementations($interfaceName);

            CacheHelper::save('Core', "ReflectionHelper.GetImplementations.{$interfaceName}", self::$_getImplementations[$interfaceName]);
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
                $filename = $file->getFilename();
                $extension = $file->getExtension();

                if ($extension === 'php')
                {
                    $className = substr($filename, 0, -4); // Remove '.php'

                    if (self::containsDefinition($path, $className))
                    {
                        $classDefinition = new ClassDefinition();
                        $classDefinition->name = $className;
                        $classDefinition->path = $path;

                        self::$_solutionClasses[$className] = $classDefinition;
                    }
                }
            }
        }
    }

    /**
     * Scan source code looking for the declaration
     * @param string $file
     * @param string $className
     * @return bool
     */
    private static function containsDefinition($file, $className)
    {
        $tokens = token_get_all(file_get_contents($file));
        $waitingClassName = false;

        foreach ($tokens as $token)
        {
            if (is_array($token))
            {
                $tokenName = token_name($token[0]);

                if ($tokenName === 'T_CLASS' || $tokenName === 'T_INTERFACE' || $tokenName === 'T_TRAIT')
                {
                    $waitingClassName = true;
                }
                elseif ($waitingClassName && $tokenName === 'T_STRING')
                {
                    if ($token[1] === $className)
                    {
                        return true;
                    }
                    else
                    {
                        $waitingClassName = false;
                    }
                }
            }
        }

        return false;
    }
}