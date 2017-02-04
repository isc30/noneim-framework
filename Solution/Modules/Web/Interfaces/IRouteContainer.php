<?php

/**
 * RouteContainer Interface
 */
interface IRouteContainer extends IContainer {
    
    /**
     * Register new Controller for Route
     * @param string[] $route
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    public function register(array $route, $controller, $method = 'index');

    /**
     * Register default Controller
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    public function registerDefault($controller, $method = 'index');

    /**
     * Register Exception Controller
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    public function registerException($controller, $method = 'index');

    /**
     * Resolve request and follow rute
     * @param WebRequest $request
     * @return ActionResult
     */
    public function resolve(WebRequest $request);
    
}