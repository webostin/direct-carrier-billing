<?php


namespace Dcb;


interface CredentialsInterface
{
    public function getLogin(): string;

    public function getPAssword(): string;
}