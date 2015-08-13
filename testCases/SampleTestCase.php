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