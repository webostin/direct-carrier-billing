<?php


namespace Tests;


use Dcb\Auth\Credentials;
use Dcb\Auth\CredentialsInterface;

class CredentialsTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Dcb\\Auth\\Credentials'));
    }

    public function testCreate()
    {
        $credentials = new Credentials('test', 'pass');
        $this->assertTrue($credentials instanceof Credentials);
        $this->assertTrue($credentials instanceof CredentialsInterface);
        $this->assertEquals('test', $credentials->getLogin());
        $this->assertEquals('pass', $credentials->getPassword());
    }
}