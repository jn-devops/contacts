<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex};
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Data;

class AIFMetadata extends Data
{
    use WithAck;

    public string $name;
    public string $civil_connection;
    public string $name_with_middle_initial;

    public function __construct(
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        public ?string $name_suffix,
        public ?string $mothers_maiden_name,
        #[WithCast(EnumCast::class)]
        public CivilStatus $civil_status,
        #[WithCast(EnumCast::class)]
        public Sex $sex,
        #[WithCast(EnumCast::class)]
        public Nationality $nationality,
        public $date_of_birth,
        public ?string $email,
        public ?string $mobile,
        public ?string $other_mobile,
        public ?string $landline,
        public ?string $tin,
        public ?string $relationship_to_buyer,
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name]));
        $this->civil_connection = $this->civil_status instanceof CivilStatus
            ? ($this->civil_status == CivilStatus::MARRIED ? $this->civil_status->value . ' to ' : $this->civil_status->value)
            : '';
        $this->name_with_middle_initial = collect([
            $first_name,
            mb_substr($middle_name ?? '', 0, 1) ? mb_substr($middle_name, 0, 1) . '.' : '',
            $last_name,
            $name_suffix
        ])->filter()->implode(' ');
    }

    public static function prepareForPipeline($properties) : array
    {
        return array_filter($properties);
    }
}
