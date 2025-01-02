<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum EmploymentType: string
{
    use EnumUtils;

    case LOCALLY_EMPLOYED = 'Locally Employed';
    case SELF_EMPLOYED = 'Self-Employed';
    case OFW = 'OFW';

    static function default(): self {
        return self::LOCALLY_EMPLOYED;
    }
}
