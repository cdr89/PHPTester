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