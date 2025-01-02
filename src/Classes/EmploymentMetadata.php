<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{Employment, EmploymentStatus, EmploymentType};
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Data;

class EmploymentMetadata extends Data
{
    use WithAck;

    public function __construct(
        public Employment $type,
        public float $monthly_gross_income,
        public EmploymentStatus $employment_status,
        public EmployerMetadata|null $employer,
        public EmploymentType|null $employment_type,
        public string|null $current_position,
        public IdMetadata|null $id
    ) {}
}
