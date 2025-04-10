<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{Industry, Nationality};
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Data;

class EmployerMetadata extends Data
{
    use WithAck;

    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $contact_no,
        #[WithCast(EnumCast::class)]
        public ?Nationality $nationality,
        #[WithCast(EnumCast::class)]
        public ?Industry $industry,
        public AddressMetadata|Optional $address,
        public ?string $year_established,
        public ?string $total_number_of_employees,
    ) {}
}
