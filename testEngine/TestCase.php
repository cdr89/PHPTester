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
            throw new AssertionFailedException('Expected "true" but was "false"');
    }

    //TODO implement other assertions

}