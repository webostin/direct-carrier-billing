<?php

namespace Dcb\Option;


class CarrierPlus implements OptionInterface
{
    public function getKey(): string
    {
        return 'CARRIER';
    }

    public function getValue(): string
    {
        return 'Plus';
    }

}