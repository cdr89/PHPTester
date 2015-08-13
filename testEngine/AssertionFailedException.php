<?php

/**
 * @author Domenico Rosario Caldesi, <d.r.caldesi@gmail.com>
 */
class AssertionFailedException extends Exception {

    public function __construct($message = "") {
        parent::__construct($message);
    }

}