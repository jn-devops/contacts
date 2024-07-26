<?php

namespace Homeful\Contacts\Data;

use Spatie\LaravelData\Data;

class PersonData extends Data
{
    public function __construct(
        public string $first_name,
        public string $middle_name,
        public string $last_name,
        public ?string $name_suffix,
        public string $civil_status,
        public string $sex,
        public string $nationality,
        public string $date_of_birth,
        public string $email,
        public string $mobile,
        public ?string $other_mobile,
        public ?string $help_number,
        public ?string $landline,
        public ?string $mothers_maiden_name,

    ) {}
}
