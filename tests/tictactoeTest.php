<?php
use PHPUnit\Framework\TestCase;

class tictactoeTest extends TestCase
{
    // constructor of the test suite
    function StringTest($name) {
        $this->PHPUnit_TestCase($name);
    }

    // called before the test functions will be executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function setUp() {
        // create a new instance of String with the
        // string 'abc'
        $this->abc = new String("abc");
    }

    public function testProcessMove()
    {
        $this->assertStringContains(',', $name);
    }

}