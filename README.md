# PHPTester
PHP testing framework

### Usage example:

###### Build your own test case:
```php
<?php
/**
 * @author Domenico Rosario Caldesi, <d.r.caldesi@gmail.com>
 */

require_once 'testEngine/TestCase.php';

class SampleTestCase extends TestCase {

    public function setUp() {
        // do nothing
        echo 'setUp() called<br/>';
    }

    public function cleanUp() {
        // do nothing
        echo 'cleanUp() called<br/>';
    }

    public function testToPass() {
        echo 'testToPass() called<br/>';
        $this->assertTrue(true);
    }

    public function testToFail() {
        echo 'testToFail() called<br/>';
        $this->assertTrue(false);
    }

    // These functions are not tested:

    private function testPrivateFunctionAreNotTested() {
        echo 'testPrivateFunctionAreNotTested() called<br/>';
        $this->assertTrue(false);
    }

    public function functionThatNotStartWithTestAreNotTested() {
        echo 'functionThatNotStartWithTestAreNotTested() called<br/>';
        $this->assertTrue(false);
    }

}
```

###### Create a launcher web page:
```php
<?php
require_once 'testCases/SampleTestCase.php';
require_once 'testEngine/TestLauncher.php';

$sampleTestCase = new SampleTestCase();
$testLauncher = new TestLauncher($sampleTestCase);
$testLauncher->doTest();
?>
```

###### You will see the output calling your test webpage from browser:
```
setUp() called
testToPass() called
testToFail() called
Assertion Failed on testToFail: Expected "true" but was "false"
cleanUp() called
```

### !!!This is still a draft of a testing framework!!!