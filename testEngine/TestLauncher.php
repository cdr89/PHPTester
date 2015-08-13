<?php

/**
 * @author Domenico Rosario Caldesi, <d.r.caldesi@gmail.com>
 */
class TestLauncher {

    private $instance;
    private $failures;
    private $successes;

    public function __construct($instance) {
        if (!$instance)
            throw new Exception('No instance specified!');
        $this->instance = $instance;
    }

    public function doTest() {
        $this->failures = array();
        $this->successes = array();
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
                    $this->handleSuccess($methodName);
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

        $this->renderResult($reflector->getName());
    }

    private function buildResult($className) {
        $result = "";
        $result .= "<!DOCTYPE html>";
        $result .= "<html>";
        $result .= "<head>";
        $result .= "<link href=\"css/test-style.css\" rel=\"stylesheet\" type=\"text/css\">";
        $result .= "</head>";
        $result .= "<body>";
        $result .= "<h1>";
        $result .= "Test results for $className:";
        $result .= "</h1>";

        if (sizeof($this->failures) > 0) {
            $result .= "<div class=\"failed\">";
            $result .= "<h2>Failed:</h2>";
            $result .= "<ul type=\"disc\">";
            foreach ($this->failures as $method => $message) {
                $result .= "<li>";
                $result .= "<h3>";
                $result .= $method . '()';
                $result .= "</h3>";
                $result .= $message;
                $result .= "</li>";
            }
            $result .= "</ul>";
            $result .= "</div>";
        }

        if (sizeof($this->successes) > 0) {
            $result .= "<div class=\"passed\">";
            $result .= "<h2>Passed:</h2>";
            $result .= "<ul type=\"disc\">";
            foreach ($this->successes as $method => $message) {
                $result .= "<li>";
                $result .= "<h3>";
                $result .= $method . '()';
                $result .= "</h3>";
                $result .= $message;
                $result .= "</li>";
            }
            $result .= "</ul>";
            $result .= "</div>";
        }

        $result .= "</body>";
        $result .= "</html>";

        return $result;
    }

    private function renderResult($className) {
        echo $this->buildResult($className);
    }

    private static function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }


    // HANDLERS FOR TEST RESULTS

    private function handleAssertionFailed($methodName, AssertionFailedException $afe) {
        $lineNumber = $afe->getTrace();
        $lineNumber = $lineNumber[0]['line'];
        $message = "Assertion Failed (@line " . $lineNumber . "): " . $afe->getMessage();
        $this->failures[$methodName] = $message;
    }

    private function handleException($methodName, Exception $e) {
        $lineNumber = $e->getLine();
        $message = "Exception (@line " . $lineNumber . "): " . $e->getMessage();
        $this->failures[$methodName] = $message;
    }

    private function handleSuccess($methodName) {
        $message = null;
        $this->successes[$methodName] = $message;
    }

}