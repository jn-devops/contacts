<?php

namespace Homeful\Contacts\Classes;

use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Attributes\{WithCast, WithTransformer};
use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex};
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\{Data, DataCollection};
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Optional;
use Illuminate\Support\Carbon;

class ContactMetaData extends Data
{
    use WithAck;

    public string $name;

    public function __construct(
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        public ?string $name_suffix,
        public ?string $mothers_maiden_name,
        public string $email,
        public string $mobile,
        public ?string $other_mobile,
        public ?string $help_number,
        public ?string $landline,
        #[WithCast(EnumCast::class)]
        public CivilStatus|Optional $civil_status,
        #[WithCast(EnumCast::class)]
        public Sex|null $sex,
        #[WithCast(EnumCast::class)]
        public Nationality|Optional $nationality,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d')]
        #[WithCast(DateTimeInterfaceCast::class, timeZone: 'Asia/Manila', format: 'Y-m-d')]
        public Carbon|null $date_of_birth,
        /** @var AddressMetadata[] */
        public ?DataCollection $addresses,
        /** @var EmploymentMetadata[] */
        public DataCollection|Optional $employment,
        public SpouseMetadata|Optional $spouse,
        /** @var CoBorrowerMetadata[] */
        public DataCollection|Optional $co_borrowers,
        public AIFMetadata|Optional $aif
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name, $this->name_suffix]));
    }

    public static function prepareForPipeline($properties) : array
    {
        return array_filter($properties);
    }
}
