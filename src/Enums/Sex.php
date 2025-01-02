<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Sex: string
{
    use EnumUtils;

    case MALE = 'Male';
    case FEMALE = 'Female';
}
