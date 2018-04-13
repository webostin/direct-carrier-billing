<?php

namespace Dcb\Option;


use Dcb\OptionInterface;

class PlayTokenOn implements OptionInterface
{
    public function getKey(): string
    {
        return 'PLAYTOKEN';
    }

    public function getValue(): string
    {
        return 'TRUE';
    }

}