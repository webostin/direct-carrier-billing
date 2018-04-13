<?php

namespace Dcb\Option;


use Dcb\OptionInterface;

class CarrierTMobile implements OptionInterface
{
    public function getKey(): string
    {
        return 'CARRIER';
    }

    public function getValue(): string
    {
        return 'TMobile';
    }

}