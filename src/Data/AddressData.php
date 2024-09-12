<?php

namespace Homeful\Contacts\Data;

use Spatie\LaravelData\Data;

class AddressData extends Data
{
    public function __construct(
        public string $type,
        public string $ownership, //owned or rented
        public ?string $full_address,
        public ?string $address1, //TODO: required dapat
        public ?string $address2,
        public ?string $sublocality, //barangay
        public ?string $locality, //city or municipality, TODO: required dapat
        public ?string $administrative_area, //province
        public ?string $postal_code, //zip code
        public ?string $sorting_code,
        public string $country,
        //for GNC 7/22/2024
        public ?string $block,
        public ?string $lot,
        public ?string $unit,
        public ?string $floor,
        public ?string $street,
        public ?string $building,
        public ?string $length_of_stay, //should be date to be calculated
        public ?string $region,
    ) {}
}
