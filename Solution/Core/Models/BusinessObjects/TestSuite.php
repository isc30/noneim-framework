<?php

/**
 * Test Suite
 */
class TestSuite implements IModel {

    /** @var IClassFactory */
    private $classFactory;
    /** @var IContextService */
    private $contextService;
    /** @var ITimeService */
    private $timeService;
    
    /** @var Context */
    private $initialContext;
    /** @var Context */
    private $emptyContext;

    /** @var ReflectionClass[] */
    private $testClasses;
    
    /**
     * TestSuite Constructor
     * @param IClassFactory $classFactory
     * @param IContextService $contextService
     * @param ITimeService $timeService
     */
    public function __construct(
        IClassFactory $classFactory,
        IContextService $contextService,
        ITimeService $timeService
    ) {
        $this->classFactory = $classFactory;
        $this->contextService = $contextService;
        $this->timeService = $timeService;
        $this->testClasses = array();
        
        $this->emptyContext = new Context();
        $this->emptyContext->time = $this->timeService->microtime();
        $this->emptyContext->sessionId = (string)new UUID();
        $this->emptyContext->session = array();
        $this->emptyContext->get = array();
        $this->emptyContext->post = array();
        $this->emptyContext->request = array();
        $this->emptyContext->headers = array();
    }

    /**
     * Add ITestClass to TestSuite
     * @param string $testClassName
     * @throws InvalidOperationException If class doesn't implement ITestClass
     */
    public function addTest($testClassName) {

        $reflectionClass = new ReflectionClass($testClassName);
        if (!$reflectionClass->implementsInterface('ITestClass')) {
            throw new InvalidOperationException("Class {$testClassName} doesn't implement ITestClass");
        }
        $this->testClasses[] = $reflectionClass;

    }

    /**
     * Run tests of all ITestClasses
     * @return TestResult[]
     */
    public function doTesting() {
        
        $this->initialContext = $this->contextService->get();

        $results = array();
        foreach ($this->testClasses as $testClass) {
            $results[] = $this->doTest($testClass);
        }
        
        $this->contextService->set($this->initialContext);

        return $results;

    }

    /**
     * Run tests of ITestClass
     * @param ReflectionClass $testClass
     * @return TestResult
     */
    private function doTest(ReflectionClass $testClass) {

        $methods = $testClass->getMethods(ReflectionMethod::IS_PUBLIC);
        $instance = $this->classFactory->instantiateReflectionClass($testClass);
        
        $testResult = new TestResult();
        $testResult->name = preg_replace('/(Test)$/', '', $testClass->name); // Remove '*Test' from class name
        $testResult->fullSuccess = true;
        
        $startTime = $this->timeService->microtime();
        
        foreach ($methods as $method) {
            
            if (substr($method->name, 0, 2) !== '__') { // Ignore magic methods
                
                try {
                    
                    for ($i = 0; $i < 10; ++$i) { // 10 repetitions
                        
                        $this->contextService->set($this->emptyContext);

                        OutputBufferHelper::start();
                        {
                            $method->invoke($instance);
                        }
                        OutputBufferHelper::end();
                        
                    }

                    $testMethod = new TestMethod();
                    $testMethod->name = $method->name;
                    $testMethod->success = true;
                    $testResult->methods[] = $testMethod;
                
                } catch (Exception $ex) {

                    $testMethod = new TestMethod();
                    $testMethod->name = $method->name;
                    $testMethod->success = false;
                    $testMethod->exception = $ex;
                    $testResult->methods[] = $testMethod;

                    $testResult->fullSuccess = false;
                    
                }
                
            }
            
        }
        
        $testResult->time = round(($this->timeService->microtime() - $startTime) * 1000, 4);
        
        return $testResult;

    }

}