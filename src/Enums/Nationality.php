<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Nationality: string
{
    use EnumUtils;

    case FILIPINO = 'Filipino';
    case AMERICAN = 'American';
    case CHINESE = 'Chinese';
    case RUSSIAN = 'Russian';

    static function default(): self {
        return self::FILIPINO;
    }
}
