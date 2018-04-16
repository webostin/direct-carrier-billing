<?php

namespace Dcb\Option;


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