<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum EmploymentStatus: string
{
    use EnumUtils;

    case REGULAR = 'Regular';
    case CONTRACTUAL = 'Contractual';
    case LOCALLY_EMPLOYED = 'Locally Employed';
    case OFW = 'Overseas Filipino Worker (OFW)';
    case SELF_EMPLOYED = 'Self Employed with Business';


    static function default(): self {
        return self::REGULAR;
    }
}
