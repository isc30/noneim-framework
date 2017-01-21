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
     * @var string
     */
    private $_type;

    /**
     * InstallerContainer Constructor
     * @param string $type
     */
    public function __construct($type)
    {
        $this->_type = $type;
        $this->instances = array();
        $this->definitions = array();
    }

    /**
     * Get container type
     * @return string
     */
    public function getType()
    {
        return $this->_type;
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
     * @param string $implementedBy Implementation class name
     * @throws InvalidOperationException If $implementedBy doesn't implement $type
     */
    public function registerDefinition($type, $implementedBy)
    {
        if (Configuration::debug && $type !== $implementedBy && !is_subclass_of($implementedBy, $type))
        {
            throw new InvalidOperationException("Class {$implementedBy} doesn't implement {$type}");
        }

        $this->definitions[$type] = $implementedBy;
    }

    /**
     * Register new Implementation for type
     * @param string $type Dependency type (Interface or Class Type)
     * @param object $implementation Implementation instance
     * @throws InvalidOperationException If $implementedBy doesn't implement $type
     */
    public function registerImplementation($type, $implementation)
    {
        if (Configuration::debug && !$implementation instanceof $type)
        {
            throw new InvalidOperationException("Class {$implementation} doesn't implement {$type}");
        }

        $this->instances[$type] = $implementation;
    }

    /**
     * Return reference to instance of type
     * @param string $type Dependency type (Interface or Class Type)
     * @return object
     * @throws DependencyNotFoundException
     */
    public function get($type)
    {
        if (!array_key_exists($type, $this->instances))
        {
            if (isset($this->definitions[$type]))
            {
                $this->instances[$type] = $this->_classFactory->instantiate($this->definitions[$type]);
            }
            else
            {
                throw new DependencyNotFoundException($type);
            }
        }

        return $this->instances[$type];
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