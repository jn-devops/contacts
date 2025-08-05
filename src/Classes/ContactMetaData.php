<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex, Suffix};
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Attributes\{WithCast, WithTransformer};
use Homeful\Contacts\Traits\HasMonthlyGrossIncome;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\{Data, DataCollection};
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Contacts\Data\OrderData;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Optional;
use Illuminate\Support\Carbon;

class ContactMetaData extends Data
{
    use HasMonthlyGrossIncome;
    use WithAck;

    public string $name;
    public float $monthly_gross_income;
    public string $civil_connection;
    public string $name_with_middle_initial;
    public array $media_urls;

    public function __construct(
        public string $id,
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        public string|null $name_suffix,
        public ?string $mothers_maiden_name,
        public string $email,
        public string $mobile,
        public ?string $other_mobile,
        public ?string $help_number,
        public ?string $landline,
        public string|Optional $civil_status,
        public string|null $sex,
        public string|Optional $nationality,
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
        $this->name = implode(' ', array_filter([$first_name, $middle_name, $last_name, $name_suffix]));
        $this->monthly_gross_income = $this->getMonthlyGrossIncome();
        $this->civil_connection = $this->civil_status instanceof CivilStatus
            ? ($this->civil_status == CivilStatus::MARRIED ? $this->civil_status->value . ' to ' : $this->civil_status->value)
            : '';
        $this->name_with_middle_initial = collect([
            $first_name,
            mb_substr($middle_name ?? '', 0, 1) ? mb_substr($middle_name, 0, 1) . '.' : '',
            $last_name,
            $name_suffix
        ])->filter()->implode(' ');
        $this->media_urls = method_exists($this, 'getMedia')
            ? $this->getMedia()->map(fn ($media) => [$media->name, $media->getUrl()])->toArray()
            : [];
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

