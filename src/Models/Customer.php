<?php

namespace Homeful\Contacts\Models;

use Homeful\Contacts\Classes\{AddressMetadata, AIFMetadata, CoBorrowerMetadata, ContactMetaData, EmploymentMetadata, SpouseMetadata};
use Propaganistas\LaravelPhone\Exceptions\CountryCodeException;
use Homeful\Contacts\Enums\{CivilStatus, Nationality, Sex};
use Homeful\Contacts\Database\Factories\CustomerFactory;
use Spatie\LaravelData\{DataCollection, WithData};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\LaravelData\Data;
use DateTimeInterface;

/**
 * Class Customer
 *
 * @method Data getData()
 */
class Customer extends Contact
{
    use WithData;

    protected $table = 'contacts';

    protected string $dataClass = ContactMetaData::class;

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    protected function casts(): array
    {
        return [
            'sex' => Sex::class,
            'civil_status' => CivilStatus::class,
            'nationality' => Nationality::class,
            'addresses' => DataCollection::class . ':' . AddressMetadata::class,
            'employment' => DataCollection::class . ':' . EmploymentMetadata::class,
            'spouse' => SpouseMetadata::class,
            'co_borrowers' => DataCollection::class . ':' . CoBorrowerMetadata::class,
            'aif' => AIFMetadata::class,
        ];
    }

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    protected function Mobile(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => phone($value, 'PH')->formatForMobileDialingInCountry('PH'),
            set: fn ($value) => phone($value, 'PH')->formatForMobileDialingInCountry('PH')
        );
    }

    /**
     * @throws CountryCodeException
     */
    public function resolveRouteBinding($value, $field = null)
    {
        try {
            $value = phone($value, 'PH')->formatForMobileDialingInCountry('PH');
        }
        catch (\Exception $e) {}

        return $this->where('mobile', $value)->firstOrFail();
    }

    public function setAddressesAttribute($value): self
    {
        $value = is_array($value) ? $value : json_decode($value, true);
        $this->attributes['addresses'] = json_encode(array_map(fn ($item) => array_filter($item), $value));

        return $this;
    }

    public function setEmploymentAttribute($value): self
    {
        if (! is_array($value)) {
            $value = json_decode($value, true);
        }

        // Recursively filter null or '' from each sub-level
        $value = filter_trim_recursive_array($value);
//dd($value);
        $this->attributes['employment'] = json_encode($value);

        return $this;
    }

    public function setCoBorrowersAttribute($value): self
    {
        $value = is_array($value) ? $value : json_decode($value, true);
        $this->attributes['co_borrowers'] = json_encode(array_map(fn ($item) => array_filter($item), $value));

        return $this;
    }
}
