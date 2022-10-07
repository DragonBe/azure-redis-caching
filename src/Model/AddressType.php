<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Model;

enum AddressType
{
    case Shipping;
    case Invoice;
}
