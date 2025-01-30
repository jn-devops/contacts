<?php

namespace Homeful\Contacts\Traits;

trait HasCode
{
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
