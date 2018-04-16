<?php


namespace Dcb\Auth;


class Credentials implements CredentialsInterface
{

    protected $login;
    protected $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}