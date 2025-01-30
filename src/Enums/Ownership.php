<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum Ownership: string
{
    use EnumUtils;
    use HasCode;

    case OWNED = 'Owned';
    case LIVING_WITH_RELATIVES = 'Living with Relatives';
    case RENTED = 'Rented';
    case MORTGAGED = 'Mortgaged';
    case UNKNOWN = 'Unknown';

    static function default(): self
    {
        return self::UNKNOWN;
    }

    public function code(): string
    {
        return match ($this) {
            self::OWNED => '001',
            self::LIVING_WITH_RELATIVES => '002',
            self::RENTED => '003',
            self::MORTGAGED => '004',
            self::UNKNOWN => 'Unknown'
        };
    }
}
