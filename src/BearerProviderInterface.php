<?php


namespace Dcb;


interface BearerProviderInterface
{
    public function getBearer(): BearerInterface;
}