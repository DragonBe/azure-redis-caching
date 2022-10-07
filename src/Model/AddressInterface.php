<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Model;

interface AddressInterface
{
    /**
     * @return AddressType
     */
    public function getAddressType(): AddressType;

    /**
     * @return string
     */
    public function getStreetAddress(): string;

    /**
     * @return string
     */
    public function getPostcode(): string;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @return string
     */
    public function getCountry(): string;
}
