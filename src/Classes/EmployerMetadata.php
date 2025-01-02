<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{Industry, Nationality};
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Data;

class EmployerMetadata extends Data
{
    use WithAck;

    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $contact_no,
        public ?Nationality $nationality,
        public ?Industry $industry,
        public ?AddressMetadata $address
    ) {}
}
