<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum EmploymentStatus: string
{
    use EnumUtils;

    case CONTRACTUAL = 'Contractual';
    case REGULAR = 'Regular';
    case LOCALLY_EMPLOYED = 'Locally Employed';
    case OFW = 'Overseas Filipino Worker (OFW)';
    case SELF_EMPLOYED = 'Self Employed with Business';


    static function default(): self {
        return self::REGULAR;
    }

    public function code(): string
    {
        return match($this) {
            self::CONTRACTUAL => '001',
            self::REGULAR => '002',
            self::LOCALLY_EMPLOYED => '003',
            self::OFW => '004',
            self::SELF_EMPLOYED => '005',
        };
    }

    static function fromCode(string $code): self {
        foreach (self::cases() as $case) {
            if ($case->code() === $code) {
                return $case;
            }
        }

        throw new \InvalidArgumentException("Invalid EmploymentStatus code: {$code}");
    }

    static function tryFromCode(string $code): self {
        try {
            return self::fromCode($code);
        } catch (\InvalidArgumentException $e) {
            return static::default();
        }
    }
}
