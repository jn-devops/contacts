<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum CivilStatus: string
{
    use EnumUtils;

    case SINGLE = 'Single';
    case MARRIED = 'Married';
    case DIVORCED = 'Divorced';
    case LEGALLY_SEPARATED = 'Legally Separated';
    case WIDOWED = 'Widowed';

    static function default(): self {
        return self::MARRIED;
    }
}
