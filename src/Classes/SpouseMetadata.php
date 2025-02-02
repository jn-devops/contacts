<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex, Suffix};
use Spatie\LaravelData\{Data, DataCollection};
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Optional;

class SpouseMetadata extends Data
{
    use WithAck;

    public string $name;

    public function __construct(
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        #[WithCast(EnumCast::class)]
        public Suffix|null $name_suffix,
        public ?string $mothers_maiden_name,
        #[WithCast(EnumCast::class)]
        public CivilStatus $civil_status,
        #[WithCast(EnumCast::class)]
        public Sex $sex,
        #[WithCast(EnumCast::class)]
        public Nationality $nationality,
        public $date_of_birth,
        /** @var EmploymentMetadata[] */
        public DataCollection|Optional $employment,
        public ?string $email,
        public ?string $mobile,
        public ?string $other_mobile,
        public ?string $landline,
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name]));
    }

    public static function prepareForPipeline($properties) : array
    {
        return array_filter($properties);
    }
}
