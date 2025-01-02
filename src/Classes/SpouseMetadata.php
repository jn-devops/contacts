<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex};
use Spatie\LaravelData\{Data, DataCollection};
use Homeful\Common\Traits\WithAck;

class SpouseMetadata extends Data
{
    use WithAck;

    public string $name;

    public function __construct(
        public string $first_name,
        public string $middle_name,
        public string $last_name,
        public ?string $name_suffix,
        public ?string $mothers_maiden_name,
        public CivilStatus $civil_status,
        public Sex $sex,
        public Nationality $nationality,
        public $date_of_birth,
        /** @var EmploymentMetadata[] */
        public ?DataCollection $employment,
        public ?string $email,
        public ?string $mobile,
        public ?string $other_mobile,
        public ?string $landline,
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name]));
    }
}
