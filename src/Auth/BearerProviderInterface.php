<?php


namespace Dcb\Auth;


interface BearerProviderInterface
{
    public function getBearer(): BearerInterface;
}