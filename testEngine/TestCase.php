<?php
/**
 * @author Domenico Rosario Caldesi, <d.r.caldesi@gmail.com>
 */
require_once('AssertionFailedException.php');

abstract class TestCase {

    /*
     * set to true if you want to call setUp() and cleanUp() for
     * each test function into your TestCase subclass.
     * */
    var $refreshForEachFuction = false;

    /*
     * Initialize all you need into the testing functions.
     * setUp() will be called once per TestCase subclass by default,
     * if you need to refresh the environment once per test function
     * set refreshForEachFuction = true;
     * */
    public abstract function setUp();

    /*
     * Clean the test environment if you used some file or put
     * entries into DB.
     * cleanUp() will be called once per TestCase subclass by default,
     * if you need to refresh the environment once per test function
     * set refreshForEachFuction = true;
     * */
    public abstract function cleanUp();

    /**
     * Assert $value == true
     * @param $value
     * @throws AssertionFailedException
     */
    public final static function assertTrue($value) {
        if ($value != true)
            throw new AssertionFailedException('Expected "true"');
    }

    /**
     * Assert $value == false
     * @param $value
     * @throws AssertionFailedException
     */
    public final static function assertFalse($value) {
        if ($value != false)
            throw new AssertionFailedException('Expected "false"');
    }

    /**
     * Assert $value1 == $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertEqual($value1, $value2) {
        if ($value1 != $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" to be equals to "' . $value2 . '""' );
    }

    /**
     * Assert $value1 != $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertNotEqual($value1, $value2) {
        if ($value1 == $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" not to be equals to "' . $value2 . '""' );
    }

    /**
     * Assert $value1 === $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertIdentical($value1, $value2) {
        if ($value1 !== $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" to be identical to "' . $value2 . '""' );
    }

    /**
     * Assert $value1 !== $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertNotIdentical($value1, $value2) {
        if ($value1 === $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" not to be identical to "' . $value2 . '""' );
    }

    /**
     * Assert $value1 < $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertLessThan($value1, $value2) {
        if ($value1 >= $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" to be less than "' . $value2 . '""' );
    }

    /**
     * Assert $value1 <= $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertLessThanOrEqual($value1, $value2) {
        if ($value1 > $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" to be less than or equal to "' . $value2 . '""' );
    }

    /**
     * Assert $value1 > $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertGreaterThan($value1, $value2) {
        if ($value1 <= $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" to be greater than "' . $value2 . '""' );
    }

    /**
     * Assert $value1 >= $value2
     * @param $value1
     * @param $value2
     * @throws AssertionFailedException
     */
    public final static function assertGreaterThanOrEqual($value1, $value2) {
        if ($value1 < $value2)
            throw new AssertionFailedException('Expected "' . $value1 . '" to be greater than or equal to "' . $value2 . '""' );
    }

}