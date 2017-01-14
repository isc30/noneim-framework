<?php

/**
 * DependencyLoader
 * @package Core
 */
class DependencyLoader
{
    /** @var null|array */
    private $applicationFiles;

    /**
     * DependencyLoader Constructor
     */
    public function __construct()
    {
        $this->applicationFiles = null;
    }

    /**
     * Register dependecy loader functions
     */
    public function loadDependencies()
    {
        $applicationFilesCacheFile = Configuration::cachesDir . 'Core/DependencyLoader.cache';

        if (Configuration::caching && file_exists($applicationFilesCacheFile))
        {
            $cache = file_get_contents($applicationFilesCacheFile);
            $this->applicationFiles = unserialize($cache);
        }
        else
        {
            $this->fillApplicationFiles();

            if (Configuration::caching)
            {
                $cache = serialize($this->applicationFiles);
                file_put_contents($applicationFilesCacheFile, $cache);
                chmod($applicationFilesCacheFile, 0664);
            }
        }

        spl_autoload_register(array($this, 'loadDependency'));
    }

    /**
     * Iterate over all the project finding executable files (php, phtml) and save them into $this->applicationFiles
     */
    private function fillApplicationFiles()
    {
        if ($this->applicationFiles !== null)
        {
            return;
        }

        $this->applicationFiles = array();
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
                    if (!isset($this->applicationFiles[$filename]))
                    {
                        $this->applicationFiles[$filename] = array();
                    }

                    $this->applicationFiles[$filename][] = $path;
                }
            }
        }
    }

    /**
     * Search and include Dependency
     * @param string $dependencyName Class, Interface or Trait name
     */
    private function loadDependency($dependencyName)
    {
        $dependencyName = "{$dependencyName}.php";

        if (isset($this->applicationFiles[$dependencyName]))
        {
            for ($i = 0, $count = count($this->applicationFiles[$dependencyName]); $i < $count; ++$i)
            {
                /** @noinspection PhpIncludeInspection */
                require_once $this->applicationFiles[$dependencyName][$i];

                unset($this->applicationFiles[$dependencyName][$i]);
            }

            unset($this->applicationFiles[$dependencyName]);
        }
    }

    /**
     * Get Solution files
     * @return null|array[]
     */
    public function getApplicationFiles()
    {
        return $this->applicationFiles;
    }
}