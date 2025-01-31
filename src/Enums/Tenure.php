<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum Tenure: string
{
    use EnumUtils;
    use HasCode;

    case LESS_THAN_A_YEAR = 'Less Than 1 Year';
    case ONE_TO_TWO_YEARS = '1 To 2 Years';
    case BEYOND_TWO_YEARS = 'Beyond 2 Years';

    static function default(): self {
        return self::BEYOND_TWO_YEARS;
    }

    public function code(): string
    {
        return match ($this) {
            self::LESS_THAN_A_YEAR => '001',
            self::ONE_TO_TWO_YEARS => '002',
            self::BEYOND_TWO_YEARS => '003'
        };
    }
}
