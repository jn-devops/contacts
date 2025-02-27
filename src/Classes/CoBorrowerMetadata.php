<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{CivilStatus, CoBorrowerType, Nationality, Relation, Sex, Suffix};
use Spatie\LaravelData\{Data, DataCollection, Optional};
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;

class CoBorrowerMetadata extends Data
{
    use WithAck;

    public string $name;
    public string $civil_connection;
    public string $name_with_middle_initial;

    public function __construct(
        #[WithCast(EnumCast::class)]
        public CoBorrowerType $type,
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
        public ?DataCollection $employment,
        public SpouseMetadata|Optional $spouse,
        /** @var AddressMetadata[] */
        public ?DataCollection $addresses,
        public ?string $email,
        public ?string $mobile,
        public ?string $other_mobile,
        public ?string $landline,
        #[WithCast(EnumCast::class)]
        public Relation|Optional $relation
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name]));
        $this->civil_connection = $this->civil_status instanceof CivilStatus
            ? ($this->civil_status == CivilStatus::MARRIED ? $this->civil_status->value . ' to ' : $this->civil_status->value)
            : '';
        $this->name_with_middle_initial = collect([
            $first_name,
            mb_substr($middle_name ?? '', 0, 1) ? mb_substr($middle_name, 0, 1) . '.' : '',
            $last_name,
            $name_suffix?->value
        ])->filter()->implode(' ');
    }

    public static function prepareForPipeline($properties) : array
    {
        return array_filter($properties);
    }
}
