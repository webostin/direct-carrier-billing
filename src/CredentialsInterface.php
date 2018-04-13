<?php


namespace Dcb;


interface CredentialsInterface
{
    public function getLogin(): string;

    public function getPassword(): string;
}