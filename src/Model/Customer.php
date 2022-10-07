<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Model;

class Customer implements CustomerInterface
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private array $addresses;
    private array $contact;

    /**
     * @param string $id
     * @param string $firstName
     * @param string $lastName
     * @param array $addresses
     * @param array $contact
     */
    public function __construct(
        string $id = '',
        string $firstName = '',
        string $lastName = '',
        array $addresses = [],
        array $contact = []
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->addresses = $addresses;
        $this->contact = $contact;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @inheritDoc
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @inheritDoc
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @inheritDoc
     */
    public function getContact(): array
    {
        return $this->contact;
    }
}
