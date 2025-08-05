<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{Employment, EmploymentStatus, EmploymentType};
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Data;
use Illuminate\Support\Arr;

class EmploymentMetadata extends Data
{
    use WithAck;

    public function __construct(
        public string $type,
        public float $monthly_gross_income,
        public string $employment_status,
        public EmployerMetadata|Optional $employer,
        public string|Optional $employment_type,
        public string|null $current_position,
        public IdMetadata $id,
        public ?string $rank,
        public ?string $years_in_service,
    ) {}

    public static function prepareForPipeline($properties) : array
    {
        return array_filter($properties);
    }
}
