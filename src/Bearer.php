<?php


namespace Dcb;


class Bearer implements BearerInterface
{

    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        $this->token;
    }

}