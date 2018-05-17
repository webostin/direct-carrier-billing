<?php


namespace Dcb\Request;


use Dcb\Model\BuyerInterface;
use Dcb\Model\MerchantInterface;
use Dcb\Model\ServiceInterface;
use Dcb\Option\OptionableInterface;

interface SubscribeInterface extends OptionableInterface
{
    public function getId(): string;

    public function getMerchant(): MerchantInterface;

    public function getBuyer(): BuyerInterface;

    public function getService(): ServiceInterface;

    public function getOptions(): array;

    public function getNotifyUrl(): string;
}