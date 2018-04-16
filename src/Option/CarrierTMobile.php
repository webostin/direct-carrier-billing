<?php

namespace Dcb\Option;


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