<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum Suffix: string
{
    use EnumUtils;
    use HasCode;

    case NA = 'N/A';
    case JR = 'Jr.';
    case SR = 'Sr.';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';
    static function default(): self
    {
        return self::NA;
    }

    public function code(): string
    {
        return match ($this) {
            self::NA => '001',
            self::JR => '002',
            self::SR => '003',
            self::II => '004',
            self::III => '005',
            self::IV => '006',
            self::V => '007',
        };
    }
}
