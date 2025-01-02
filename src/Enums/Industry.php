<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Industry: string
{
    use EnumUtils;

    case BPO = 'BPO';
    case MEDICAL = 'Medical';
    case MARITIME = 'Maritime';

    static function default(): self {
        return self::BPO;
    }
}
