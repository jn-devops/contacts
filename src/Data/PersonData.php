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
        public ?string $date_of_birth,
        public string $email,
        public string $mobile,
        public ?string $other_mobile,
        public ?string $help_number,
        public ?string $landline,
        public ?string $mothers_maiden_name,
        public ?string $age,
        public ?string $relationship_to_buyer,
        public ?string $passport,
        public ?string $date_issued,
        public ?string $place_issued,

    ) {}

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name ?? '',
            'middle_name' => $this->middle_name ?? '',
            'last_name' => $this->last_name ?? '',
            'name_suffix' => $this->name_suffix ?? '',
            'civil_status' => $this->civil_status ?? '',
            'sex' => $this->sex ?? '',
            'nationality' => $this->nationality ?? '',
            'date_of_birth' => $this->date_of_birth ?? '',
            'email' => $this->email ?? '',
            'mobile' => $this->mobile ?? '',
            'other_mobile' => $this->other_mobile ?? '',
            'help_number' => $this->help_number ?? '',
            'landline' => $this->landline ?? '',
            'mothers_maiden_name' => $this->mothers_maiden_name ?? '',
            'age' => $this->age ?? '',
            'relationship_to_buyer' => $this->relationship_to_buyer ?? '',
            'passport' => $this->passport ?? '',
            'date_issued' => $this->date_issued ?? '',
            'place_issued' => $this->place_issued ?? '',
        ];
    }
}
