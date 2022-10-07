<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Model;

interface ContactInterface
{
    /**
     * @return ContactType
     */
    public function getContactType(): ContactType;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getPhone(): string;
}
