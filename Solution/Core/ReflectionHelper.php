<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 21/01/2017
 * Time: 22:14
 */
class ReflectionHelper
{
    /** @var ClassDefinition[] */
    private static $solutionClasses = null;

    /**
     * @return ClassDefinition[]
     */
    public static function getSolutionClasses()
    {
        if (self::$solutionClasses !== null)
        {
            return self::$solutionClasses; // Already filled
        }

        if (!CacheHelper::load('Core', 'ReflectionHelper.SolutionClasses', self::$solutionClasses))
        {
            self::prepareAutoloaderFiles();

            CacheHelper::save('Core', 'ReflectionHelper.SolutionClasses', self::$solutionClasses);
        }

        return self::$solutionClasses;
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

    private static function prepareAutoloaderFiles()
    {
        self::$solutionClasses = array();
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(Configuration::rootDir));

        foreach ($iterator as $file)
        {
            if ($file->isFile())
            {
                $path = $file->getPathname();
                $filename = $file->getFilename();
                $extension = $file->getExtension();

                if ($extension === 'php')
                {
                    $className = substr($filename, 0, -4);

                    $classDefinition = new ClassDefinition();
                    $classDefinition->name = $className;
                    $classDefinition->path = $path;

                    self::$solutionClasses[$className] = $classDefinition;
                }
            }
        }
    }
}