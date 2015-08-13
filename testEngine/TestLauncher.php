<?php

/**
 * @author Domenico Rosario Caldesi, <d.r.caldesi@gmail.com>
 */
class TestLauncher {

    private $instance;

    public function __construct($instance) {
        if (!$instance)
            throw new Exception('No instance specified!');
        $this->instance = $instance;
    }

    public function doTest() {
        $reflector = new ReflectionClass($this->instance);
        if (!$reflector->isSubclassOf('TestCase'))
            throw new Exception('Instance to test is not a TestCase subclass!');

        $refreshForEachFuction = $reflector->getProperty('refreshForEachFuction')->getValue($this->instance);
        if (!$refreshForEachFuction)
            $reflector->getMethod('setUp')->invoke($this->instance);

        $methods = $reflector->getMethods();
        foreach ($methods as $method) {
            $methodName = $method->getName();
            if (!$method->isPrivate() && self::startsWith(strtoupper($methodName), "TEST")) {
                if ($refreshForEachFuction)
                    $reflector->getMethod('setUp')->invoke($this->instance);
                try {
                    $method->invoke($this->instance);
                } catch (AssertionFailedException $afe) {
                    $this->handleAssertionFailed($methodName, $afe);
                } catch (Exception $e) {
                    $this->handleException($methodName, $e);
                }
                if ($refreshForEachFuction)
                    $reflector->getMethod('cleanUp')->invoke($this->instance);
            }
        }

        if (!$refreshForEachFuction)
            $reflector->getMethod('cleanUp')->invoke($this->instance);
    }

    private static function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    private function handleAssertionFailed($methodName, AssertionFailedException $afe) {
        // TODO
        echo "Assertion Failed on $methodName: " . $afe->getMessage() . "<br/>";
    }

    private function handleException($methodName, Exception $e) {
        // TODO
        echo "Exception on $methodName: " . $e->getMessage(). "<br/>";
    }

}