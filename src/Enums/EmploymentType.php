<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum EmploymentType: string
{
    use EnumUtils;
    use HasCode;

    case LOCALLY_EMPLOYED = 'Locally Employed';
    case SELF_EMPLOYED = 'Self-Employed';
    case OFW = 'Overseas Filipino Worker (OFW)';

    static function default(): self {
        return self::LOCALLY_EMPLOYED;
    }

    public function code(): string
    {
        return match($this) {
            self::LOCALLY_EMPLOYED => '001',
            self::SELF_EMPLOYED => '002',
            self::OFW => '003'
        };
    }
}
