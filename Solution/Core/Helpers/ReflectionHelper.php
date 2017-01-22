<?php

/**
 * Reflection Helper
 * @package Core
 * @subpackage Helpers
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
     * @param string $interfaceName
     * @return ClassDefinition[]
     */
    public static function getImplementations($interfaceName)
    {
        $classList = array();

        foreach (self::getSolutionClasses() as $class => $definition)
        {
            $rc = new ReflectionClass($definition->name);

            if (!$rc->isInterface() && $rc->implementsInterface($interfaceName))
            {
                $classList[] = $definition;
            }
        }

        return $classList;
    }

    private static function fillSolutionClasses()
    {
        self::$_solutionClasses = array();
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(Configuration::$solutionPath));

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

                    $classDefinition = new ClassDefinition();
                    $classDefinition->name = $className;
                    $classDefinition->path = $path;

                    self::$_solutionClasses[$className] = $classDefinition;
                }
            }
        }
    }
}