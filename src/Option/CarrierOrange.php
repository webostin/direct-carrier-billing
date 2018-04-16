<?php

namespace Dcb\Option;


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