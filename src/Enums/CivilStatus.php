<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum CivilStatus: string
{
    use EnumUtils;

    case SINGLE = 'Single';
    case MARRIED = 'Married';
    case WIDOWED = 'Widowed';
    case DIVORCED = 'Divorced';
    case SEPARATED = 'Separated';
    case WIDOW_ER = 'Widow/er';


    static function default(): self {
        return self::MARRIED;
    }
}
