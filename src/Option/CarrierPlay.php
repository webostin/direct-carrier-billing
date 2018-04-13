<?php

namespace Dcb\Option;


use Dcb\OptionInterface;

class CarrierPlay implements OptionInterface
{
    public function getKey(): string
    {
        return 'CARRIER';
    }

    public function getValue(): string
    {
        return 'Play';
    }

}