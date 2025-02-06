<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex, Suffix};
use Homeful\Contacts\Data\OrderData;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Attributes\{WithCast, WithTransformer};
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
        #[WithCast(EnumCast::class)]
        public Suffix|null $name_suffix,
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
        public AIFMetadata|Optional $aif,
        public OrderData|Optional $order
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name, $name_suffix?->value]));
    }

    public static function prepareForPipeline($properties): array
    {
        // Ensure addresses are properly prepared
        if (isset($properties['addresses']) && $properties['addresses'] instanceof DataCollection) {
            $properties['addresses'] = $properties['addresses']->toArray();
        }

        // Ensure employment are properly prepared
        if (isset($properties['employment']) && $properties['employment'] instanceof DataCollection) {
            $properties['employment'] = $properties['employment']->toArray();
        }

        // Ensure spouse is properly prepared
        if (isset($properties['spouse']) && $properties['spouse'] instanceof SpouseMetadata) {
            $properties['spouse'] = $properties['spouse']->toArray();
        }

        // Ensure aif is properly prepared
        if (isset($properties['aif']) && $properties['aif'] instanceof AIFMetadata) {
            $properties['aif'] = $properties['aif']->toArray();
        }

        // Ensure co_borrowers are properly prepared
        if (isset($properties['co_borrowers']) && $properties['co_borrowers'] instanceof DataCollection) {
            $properties['co_borrowers'] = $properties['co_borrowers']->toArray();
        }

        // Filter and clean up the properties
        return array_filter($properties);
    }
}

