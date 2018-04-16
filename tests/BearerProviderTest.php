<?php


namespace Tests;


use Dcb\Auth\BearerProvider;
use Dcb\Auth\BearerProviderInterface;
use Dcb\Auth\Credentials;
use Dcb\Auth\CredentialsInterface;
use Dcb\Exceptions\InvalidCredentialsException;

class BearerProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Dcb\\Auth\\BearerProvider'));
    }

    public function testCreate()
    {
        $credentials = $this->createMock('Dcb\\Auth\\CredentialsInterface');
        $this->assertTrue($credentials instanceof CredentialsInterface);
        $provider = new BearerProvider($credentials, 'http://test.example');
        $this->assertTrue($provider instanceof BearerProviderInterface);
    }

    public function testIsLogin()
    {
        $credentials = $this->createMock('Dcb\\Auth\\CredentialsInterface');
        $this->assertTrue($credentials instanceof CredentialsInterface);
        $provider = new BearerProvider($credentials, 'http://test.example');
        $this->assertTrue($provider instanceof BearerProviderInterface);
        $this->assertTrue($provider instanceof BearerProvider);

        $this->assertFalse($provider->isLoggedIn());
    }

    public function testLogin()
    {
        $credentials = new Credentials('test', 'testowy');
        $provider = new BearerProvider($credentials, 'https://private-anon-c2c51e0e12-taauth.apiary-mock.com');

        $this->assertFalse($provider->isLoggedIn());

        $provider->login();

        $this->assertTrue($provider->isLoggedIn());
    }


    public function testLoginFail()
    {
        $credentials = $this->createMock('Dcb\\Auth\\CredentialsInterface');
        $provider = new BearerProvider($credentials, 'http://test.example');

        $this->assertFalse($provider->isLoggedIn());
        try {
            $provider->login();
        } catch (InvalidCredentialsException $exception) {

        }

        $this->assertFalse($provider->isLoggedIn());
    }
}