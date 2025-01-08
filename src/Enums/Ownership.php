<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Ownership: string
{
    use EnumUtils;

    case OWNED = 'Owned';
    case LIVING_WITH_RELATIVES = 'Living with Relatives';
    case RENTED = 'Rented';

    static function default(): self {
        return self::UNKNOWN;
    }
}
