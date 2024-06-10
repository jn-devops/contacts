<?php

namespace Homeful\Contacts\Data;

use Spatie\LaravelData\Data;

class PersonData extends Data
{
    public function __construct(
        public string $first_name,
        public string $middle_name,
        public string $last_name,
        public string $civil_status,
        public string $sex,
        public string $nationality,
        public string $date_of_birth,
        public string $email,
        public string $mobile,
    ) {
    }
}
