<?php

/**
 * Installer Container
 * @package Core
 * @subpackage Containers
 */
class InstallerContainer implements IInstallerContainer, ICacheable
{
    /** @var IClassFactory */
    private $_classFactory;
    
    /**
     * Cache of dependency instances (type => instance)
     * @var array
     */
    private $instances;
    
    /**
     * Installers for dependencies (type => implementedBy)
     * @var array
     */
    private $definitions;

    /**
     * InstallerContainer Constructor
     */
    public function __construct()
    {
        $this->instances = array();
        $this->definitions = array();
    }
    
    /**
     * Set ClassFactory
     * @param IClassFactory $classFactory
     */
    public function setClassFactory(IClassFactory $classFactory)
    {
        $this->_classFactory = $classFactory;
    }
    
    /**
     * Register new Installer for dependency
     * @param string $type Dependency type (Interface or Class Type)
     * @param string|object $implementedBy Implementation class (name or instance)
     * @throws InvalidOperationException If $implementedBy doesn't implement $type
     */
    public function register($type, $implementedBy)
    {
        if (is_string($implementedBy))
        {
            if (Configuration::debug && $type !== $implementedBy && !is_subclass_of($implementedBy, $type))
            {
                throw new InvalidOperationException("Class {$implementedBy} doesn't implement {$type}");
            }

            $this->definitions[$type] = $implementedBy;
        }
        else
        {
            if (Configuration::debug && !$implementedBy instanceof $type)
            {
                throw new InvalidOperationException("Class {$implementedBy} doesn't implement {$type}");
            }

            $this->instances[$type] = $implementedBy;
        }
    }

    /**
     * Return Instance of Dependency
     * @param string $type Dependency type (Interface or Class Type)
     * @return object
     * @throws DependencyNotFoundException
     * @throws Exception
     */
    public function get($type)
    {
        if (array_key_exists($type, $this->instances))
        {
            return $this->instances[$type];
        }
        else
        {
            if (isset($this->definitions[$type]))
            {
                try
                {
                    $instance = $this->_classFactory->instantiate($this->definitions[$type]);
                }
                catch (Exception $ex)
                {
                    if (!isset($instance))
                    {
                        throw $ex;
                    }
                }
                $this->instances[$type] = $instance;

                return $instance;
            }
            else
            {
                throw new DependencyNotFoundException($type);
            }
        }
    }

    /**
     * Get Cache
     * @return string
     */
    public function getCache()
    {
        return serialize($this->definitions);
    }
    
    /**
     * Set Cache
     * @param string $cache
     */
    public function setCache($cache)
    {
        $this->definitions = unserialize($cache);
    }
}