<?php


namespace Dcb\Auth;


class Bearer implements BearerInterface
{

    protected $token;

    protected $expires;

    public function __construct(string $token, int $expires)
    {
        $this->token = $token;
        $this->expires = $expires;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpires()
    {
        return $this->expires;
    }

}