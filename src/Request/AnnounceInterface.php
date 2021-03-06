<?php

namespace Dcb\Request;


use Dcb\Model\BuyerInterface;
use Dcb\Model\MerchantInterface;
use Dcb\Model\ServiceInterface;
use Dcb\Option\OptionableInterface;

interface AnnounceInterface extends OptionableInterface
{
    public function getId(): string;

    public function getMerchant(): MerchantInterface;

    public function getRedirectTo(): string;

    public function getNotifyUrl(): string;

    public function getBuyer(): BuyerInterface;

    public function getService(): ServiceInterface;

    public function getOptions(): array;
}