<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{AddressType, Ownership};
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Data;

class AddressMetadata extends Data
{
    use WithAck;

    public string $address;
    public string $short_address;

    public function __construct(
        #[WithCast(EnumCast::class)]
        public ?AddressType $type,
        #[WithCast(EnumCast::class)]
        public ?Ownership $ownership,
        public ?string $address1,
        public ?string $sublocality,
        public ?string $locality,
        public ?string $administrative_area,
        public ?string $postal_code,
        public ?string $region,
        public ?string $country
    ) {
        $this->address = implode(', ', array_filter([$this->address1, $this->sublocality, $this->locality, $this->administrative_area, $this->postal_code]));
        $this->short_address = '156 Soliven St., Pasig Green Park Village, Barangay Manggahan, Pasig City 1605';
    }
}
