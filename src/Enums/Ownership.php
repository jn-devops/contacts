<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Ownership: string
{
    use EnumUtils;

    case OWNED = 'Owned';
    case RENTED = 'Rented';
    case UNKNOWN = 'Unknown';

    static function default(): self {
        return self::UNKNOWN;
    }
}
