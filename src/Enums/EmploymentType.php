<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum EmploymentType: string
{
    use EnumUtils;

    case LOCALLY_EMPLOYED = 'Locally Employed';
    case SELF_EMPLOYED = 'Self-Employed';
    case OFW = 'Overseas Filipino Worker (OFW)';

    static function default(): self {
        return self::LOCALLY_EMPLOYED;
    }

    public function sync_id(): string
    {
        return match($this) {
            self::LOCALLY_EMPLOYED => '001',
            self::SELF_EMPLOYED => '002',
            self::OFW => '003'
        };
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
