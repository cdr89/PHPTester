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
    }

    public function cleanUp() {
        // do nothing
    }

    public function testToPass() {
        $this->assertTrue(true);
    }

    public function testToFail() {
        $this->assertTrue(false);
    }

    public function testThatRaiseAnException() {
        throw new Exception('exceptionMessage');
    }

    // These functions are not tested:

    private function testPrivateFunctionAreNotTested() {
        $this->assertTrue(false);
    }

    public function functionThatNotStartWithTestAreNotTested() {
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
[http://localhost/PHPTester/test.php](http://localhost/PHPTester/test.php)