<?php

namespace Dcb\Option;


use Dcb\OptionInterface;

class CarrierOrange implements OptionInterface
{
    public function getKey(): string
    {
        return 'CARRIER';
    }

    public function getValue(): string
    {
        return 'Orange';
    }

}