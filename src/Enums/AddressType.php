<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum AddressType: string
{
    use EnumUtils;
    use HasCode;

    case PRESENT = 'Present';
    case PERMANENT = 'Permanent';
    case PRIMARY = 'Primary';
    case SECONDARY = 'Secondary';
    case WORK = 'Work';//Employer Address is probably better

    static function default(): self {
        return self::PRIMARY;
    }

    public function code(): string
    {
        return match($this) {
            self::PRESENT => 'present',
            self::PERMANENT => 'permanent',
            self::PRIMARY => 'primary',
            self::SECONDARY => 'co_borrower',
            self::WORK => 'company',
        };
    }
}
