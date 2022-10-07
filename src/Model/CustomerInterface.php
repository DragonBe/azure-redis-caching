<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Model;

interface CustomerInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return array
     */
    public function getAddresses(): array;

    /**
     * @return array
     */
    public function getContact(): array;
}
