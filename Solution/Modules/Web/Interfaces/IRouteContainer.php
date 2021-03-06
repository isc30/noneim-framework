<?php

/**
 * RouteContainer Interface
 */
interface IRouteContainer
{
    /**
     * Register new Controller for Route
     * @param string[] $route
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't extend Controller
     */
    public function register(array $route, $controller, $method = 'index');

    /**
     * Register default Controller
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't extend Controller
     */
    public function registerDefault($controller, $method = 'index');

    /**
     * Register Exception Controller
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't extend Controller
     */
    public function registerException($controller, $method = 'index');

    /**
     * Resolve request and follow route
     * @param WebRequest $request
     * @return ActionResult
     */
    public function resolve(WebRequest $request);
}