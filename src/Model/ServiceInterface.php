<?php


namespace Dcb\Model;


interface ServiceInterface
{
    public function getId(): int;

    public function getQuantity(): int;

    public function getPrice(): int;
}