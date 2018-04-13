<?php


namespace Dcb;


interface BearerInterface
{
    public function getToken(): string;
}