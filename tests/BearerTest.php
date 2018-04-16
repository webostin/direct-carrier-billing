<?php

namespace Tests;


use Dcb\Auth\Bearer;
use Dcb\Auth\BearerInterface;

class BearerTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Dcb\\Auth\\Bearer'));
    }

    public function testCreate()
    {
        $bearer = new Bearer('testtoken', 1523779713);
        $this->assertTrue($bearer instanceof Bearer);
        $this->assertTrue($bearer instanceof BearerInterface);
        $this->assertEquals($bearer->getToken(), 'testtoken');
        $this->assertEquals($bearer->getExpires(), 1523779713);
    }
}