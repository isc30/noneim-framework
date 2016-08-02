<?php

/**
 * Route Container
 * @package Core
 * @subpackage Containers
 */
class RouteContainer implements IRouteContainer, ICacheable {
    
    /** @var IClassFactory */
    private $_classFactory;
    
    /**
     * Default Route (404)
     * @var Route
     */
    private $defaultRoute;
    
    /**
     * Exception Route
     * @var Route
     */
    private $exceptionRoute;

    /**
     * Route array
     * @var Route[]
     */
    private $routes;
    
    public function __construct(
        IClassFactory $classFactory
    ) {
        $this->_classFactory = $classFactory;
        $this->routes = array();
    }
    
    /**
     * Register new Controller for Route
     * @param string[] $route
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    public function register(array $route, $controller, $method = 'index') {

        $this->searchForInvalidCharacters($route);
        $this->testControllerType($controller);

        $currentRoute = preg_quote(implode($this->getSeparator(), $route), '/');
        $originalRoute = preg_replace('(\\\{([^\}]+)\\\})', '{$1}', $currentRoute);
        $regexRoute = preg_replace('(\\\{([^\}]+)\\\})', '([^' . $this->getScapedSeparator(). ']+)', $currentRoute);

        // Generate Indices
        preg_match_all('/\{([^\}]+)\}/i', $originalRoute, $arguments);
        $arguments = $arguments[1];

        $newRoute = new Route();
        $newRoute->originalRoute = $originalRoute;
        $newRoute->regexRoute = $regexRoute;
        $newRoute->controller = $controller;
        $newRoute->method = $method;
        $newRoute->arguments = $arguments;
        $this->routes[] = $newRoute;

    }

    /**
     * Register default Controller
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    public function registerDefault($controller, $method = 'index') {

        $this->testControllerType($controller);

        $newRoute = new Route();
        $newRoute->controller = $controller;
        $newRoute->method = $method;
        $this->defaultRoute = $newRoute;

    }
    
    /**
     * Register Exception Controller
     * @param string $controller
     * @param string $method
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    public function registerException($controller, $method = 'index') {

        $this->testControllerType($controller);

        $newRoute = new Route();
        $newRoute->controller = $controller;
        $newRoute->method = $method;
        $this->exceptionRoute = $newRoute;

    }
    
    /**
     * Resolve request and follow rute
     * @param string[] $request
     * @return IActionResult
     */
    public function resolve(array $request) {

        $requestString = implode($this->getSeparator(), $request);
        $route = $this->getCurrentRoute($requestString);
        $arguments = $this->getArguments($requestString, $route);
        
        try {
            $actionResult = $this->_classFactory->call($route->controller, $route->method, $arguments);
        } catch (Exception $ex) {
            if ($this->exceptionRoute !== null) {
                $actionResult = $this->_classFactory->call($this->exceptionRoute->controller, $this->exceptionRoute->method, array($ex));
            } else {
                $actionResult = new StringActionResult($ex->getMessage());
            }
        }

        return $actionResult;

    }

    /**
     * Return current Route
     * @param string $requestString
     * @return Route
     * @throws InvalidOperationException If there are too many possible routes
     */
    private function getCurrentRoute($requestString) {

        $possibleRoutes = $this->getPossibleRoutes($requestString);
        $possibleRoutesCount = count($possibleRoutes);

        if ($possibleRoutesCount === 1) {

            return $possibleRoutes[0];

        } else if ($possibleRoutesCount == 0) {

            return $this->defaultRoute;

        } else {

            throw new InvalidOperationException("Too Many Possible Routes: {$possibleRoutesCount}");

        }

    }

    /**
     * Return possible Routes
     * @param string $requestString
     * @return Route[]
     */
    private function getPossibleRoutes($requestString) {

        $possibleRoutes = array();

        foreach ($this->routes as $route) {

            if (preg_match("/^{$route->regexRoute}$/i", $requestString)) {

                $possibleRoutes[] = $route;

            }

        }

        return $possibleRoutes;

    }
    
    /**
     * Search for invalid characters in Route (separator + empty sections)
     * @param string[] $route
     * @throws InvalidOperationException If invalid characters found or some section is empty
     */
    private function searchForInvalidCharacters(array $route) {
        
        $separator = self::getSeparator();
        
        foreach ($route as $section) {
            
            if (strpos($section, $separator) !== false) {
                throw new InvalidOperationException('Invalid characters found');
            }
            
            if ($section === '') {
                throw new InvalidOperationException('Some section is empty');
            }
            
        }
        
    }
    
    /**
     * Return section separator
     * @return string
     */
    private function getSeparator() {
        
        return Configuration::subsectionSeparator;
        
    }
    
    /**
     * Return scaped section separator
     * @return string
     */
    private function getScapedSeparator() {
        
        return preg_quote(self::getSeparator(), '/');
        
    }
    
    /**
     * Get arguments for route
     * @param string $request
     * @param Route $route
     * @return mixed[]
     */
    private function getArguments($request, $route) {
        
        $params = array();
        
        preg_match("/^{$route->regexRoute}$/i", $request, $values);
        array_shift($values);
        
        foreach ($values as $i => $value) {
            $params[$route->arguments[$i]] = $value;
        }
        
        return $params;
        
    }

    /**
     * Test if Controller implements IController
     * @param string $controller
     * @throws InvalidOperationException If $controller doesn't implement IController
     */
    private function testControllerType($controller) {

        if (Configuration::debug && !is_subclass_of($controller, 'IController')) {
            throw new InvalidOperationException("Class {$controller} doesn't implement IController");
        }

    }

    /**
     * Get Cache
     * @return string
     */
    public function getCache() {
        
        return serialize(array(
            'default' => $this->defaultRoute,
            'exception' => $this->exceptionRoute,
            'routes' => $this->routes
        ));
        
    }
    
    /**
     * Set Cache
     * @param string $cache
     */
    public function setCache($cache){
        
        $data = unserialize($cache);
        
        $this->defaultRoute = $data['default'];
        $this->exceptionRoute = $data['exception'];
        $this->routes = $data['routes'];
        
    }

}