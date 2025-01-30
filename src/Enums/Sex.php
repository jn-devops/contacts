<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Sex: string
{
    use EnumUtils;

    case MALE = 'Male';
    case FEMALE = 'Female';

    public function other(): self
    {
        return $this === self::MALE ? self::FEMALE : self::MALE;
    }
}
