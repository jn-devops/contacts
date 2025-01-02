<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum AddressType: string
{
    use EnumUtils;

    case PRIMARY = 'Primary';
    case SECONDARY = 'Secondary';
    case WORK = 'Work';//Employer Address is probably better

    static function default(): self {
        return self::PRIMARY;
    }
}
