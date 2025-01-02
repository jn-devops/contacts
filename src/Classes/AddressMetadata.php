<?php

namespace Homeful\Contacts\Classes;

use Homeful\Contacts\Enums\{AddressType, Ownership};
use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Data;

class AddressMetadata extends Data
{
    use WithAck;

    public string $address;

    public function __construct(
        public AddressType $type,
        public Ownership $ownership,
        public string $address1,
        public string $locality,
        public string $administrative_area,
        public string $postal_code,
        public string $region,
        public string $country
    ) {
        $this->address = implode(', ', array_filter([$this->address1, $this->locality, $this->administrative_area, $this->postal_code]));
    }
}
