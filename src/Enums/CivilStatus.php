<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum CivilStatus: string
{
    use EnumUtils;
    use HasCode;

    case SINGLE = 'Single';
    case MARRIED = 'Married';
    case WIDOWED = 'Widowed';
    case DIVORCED = 'Divorced';
    case SEPARATED = 'Separated';
    case WIDOW_ER = 'Widow/er';

    static function default(): self {
        return self::MARRIED;
    }

    public function code(): string
    {
        return match($this) {
            self::SINGLE => '001',
            self::MARRIED => '002',
            self::WIDOWED => '003',
            self::DIVORCED => '004',
            self::SEPARATED => '005',
            self::WIDOW_ER => '006',
        };
    }
}
