<?php


namespace Dcb\Auth;


interface BearerInterface
{
    public function getToken(): string;
}