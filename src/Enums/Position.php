<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum Position: string
{
    use EnumUtils;
    use HasCode;

    case ABLE_SEAMAN = 'Able Seaman';
    case ACCOUNT_ASSOCIATE = 'Account Associate';
    case SALES_PROMOTER = 'Sales Promoter';
    case SALESMAN = 'Salesman';

    static function default(): self {
        return self::SALESMAN;
    }

    public function code(): string
    {
        return match ($this) {
            self::ABLE_SEAMAN => '001',
            self::ACCOUNT_ASSOCIATE => '002',
            self::SALES_PROMOTER => '231',
            default => '234' //SALESMAN
        };
    }
}
