<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum CoBorrowerType: string
{
    use EnumUtils;

    case PRIMARY = 'Primary';
    case SECONDARY = 'Secondary';

    static function default(): self {
        return self::PRIMARY;
    }
}
