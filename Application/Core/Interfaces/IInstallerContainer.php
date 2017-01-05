<?php

/**
 * InstallerContainer Interface
 * @package Core
 * @subpackage Interfaces
 */
interface IInstallerContainer extends IContainer {
    
    /**
     * Register new Installer for dependency
     * @param string $type Dependency type (Interface or Class Type)
     * @param string|object $implementedBy Implementation class (name or instance)
     * @throws InvalidOperationException If $implementedBy doesn't implement $type
     */
    public function register($type, $implementedBy);

    /**
     * Return Instance of Dependency
     * @param string $type Dependency type (Interface or Class Type)
     * @return object
     * @throws DependencyNotFoundException
     * @throws Exception
     */
    public function &get($type);
    
}