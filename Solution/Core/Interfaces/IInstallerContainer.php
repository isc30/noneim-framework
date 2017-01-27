<?php

/**
 * InstallerContainer Interface
 * @package Core
 * @subpackage Interfaces
 */
interface IInstallerContainer extends IContainer
{
    /**
     * IInstallerContainer Constructor
     */
    public function __construct();

    /**
     * Register new Installer for dependency
     * @param string $type Dependency type (Interface or Class Type)
     * @param string $implementedBy Implementation class name
     * @throws InvalidOperationException If $implementedBy doesn't implement $type
     */
    public function registerDefinition($type, $implementedBy);

    /**
     * Register new Implementation for type
     * @param string $type Dependency type (Interface or Class Type)
     * @param object $implementation Implementation instance
     * @throws InvalidOperationException If $implementedBy doesn't implement $type
     */
    public function registerImplementation($type, $implementation);

    /**
     * Return reference to instance of type
     * @param string $type Dependency type (Interface or Class Type)
     * @return object
     * @throws DependencyNotFoundException
     */
    public function get($type);
}