<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum Relation: string
{
    use EnumUtils;
    use HasCode;

    case SIBLING = 'Sibling';
    case PARENT = 'Parent';
    case SPOUSE = 'Spouse';
    case AUNT_UNCLE = 'Aunt/Uncle';
    case COUSIN = 'Cousin';
    case NEPHEW_NIECE = 'Nephew/Niece';
    case STEPPARENT_STEPCHILDREN = 'Stepparent/Stepchildren';
    case FRIEND = 'Friend';
    case OTHER = 'Other';
    case LIVE_IN_PARTNER = 'Live-In Partner';

    static function default(): self
    {
        return self::OTHER;
    }

    public function code(): string
    {
        return match ($this) {
            self::SIBLING => '001',
            self::PARENT => '002',
            self::SPOUSE => '003',
            self::AUNT_UNCLE => '004',
            self::COUSIN => '005',
            self::NEPHEW_NIECE => '006',
            self::STEPPARENT_STEPCHILDREN => '007',
            self::FRIEND => '008',
            self::OTHER => '009',
            self::LIVE_IN_PARTNER => '010'
        };
    }
}
