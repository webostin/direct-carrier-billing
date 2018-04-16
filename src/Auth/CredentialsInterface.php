<?php


namespace Dcb\Auth;


interface CredentialsInterface
{
    public function getLogin(): string;

    public function getPassword(): string;
}