<?php


namespace Dcb;


interface OptionInterface
{
    public function getKey(): string;

    public function getValue(): string;
}