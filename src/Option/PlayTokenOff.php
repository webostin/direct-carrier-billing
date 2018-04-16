<?php

namespace Dcb\Option;


class PlayTokenOff implements OptionInterface
{
    public function getKey(): string
    {
        return 'PLAYTOKEN';
    }

    public function getValue(): string
    {
        return 'FALSE';
    }

}