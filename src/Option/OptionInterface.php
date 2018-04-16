<?php


namespace Dcb\Option;


interface OptionInterface
{
    public function getKey(): string;

    public function getValue(): string;
}