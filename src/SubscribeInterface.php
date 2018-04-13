<?php


namespace Dcb;


interface SubscribeInterface extends OptionableInterface
{
    public function getId(): string;

    public function getMerchant(): MerchantInterface;

    public function getBuyer(): BuyerInterface;

    public function getService(): ServiceInterface;

    public function getOptions(): array;
}