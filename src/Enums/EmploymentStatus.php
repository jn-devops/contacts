<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum EmploymentStatus: string
{
    use EnumUtils;
    use HasCode;

    case CONTRACTUAL = 'Contractual';
    case REGULAR = 'Regular';

    static function default(): self {
        return self::REGULAR;
    }

    public function code(): string
    {
        return match($this) {
            self::CONTRACTUAL => '001',
            self::REGULAR => '002',
        };
    }
}
