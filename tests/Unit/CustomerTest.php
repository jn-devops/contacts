<?php

use Homeful\Contacts\Enums\{AddressType, CivilStatus, CoBorrowerType, Employment, EmploymentStatus, EmploymentType,  Industry, Nationality, Ownership, Sex};
use Homeful\Contacts\Classes\{AddressMetadata, AIFMetadata, CoBorrowerMetadata, ContactMetaData, EmploymentMetadata, SpouseMetadata};
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Illuminate\Support\Facades\Notification;
use Spatie\LaravelData\DataCollection;
use Homeful\Contacts\Models\Customer;

uses(RefreshDatabase::class, WithFaker::class);

beforeEach(function () {
    Notification::fake();
});

test('customer has attributes', function () {
    $customer = Customer::create([
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->email(),
        'mobile' => '09181234567',
        'middle_name' => fake()->lastName(), //should be  optional
        'civil_status' => CivilStatus::random()->value,
        'sex' => Sex::random()->value,
        'nationality' => Nationality::random()->value,
        'date_of_birth' => fake()->date(),
    ]);
    expect($customer)->toBeInstanceOf(Customer::class);
    expect(ContactMetaData::from($customer->toArray()))->toBeInstanceOf(ContactMetaData::class);
});

test('customer has minimum attributes', function () {
    $customer = Customer::create([
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->email(),
        'mobile' => '09181234567',
    ]);
    expect($customer)->toBeInstanceOf(Customer::class);
    expect(ContactMetaData::from($customer->toArray()))->toBeInstanceOf(ContactMetaData::class);
});

dataset('customer', function () {
    return [
        fn () => Customer::create([
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'mobile' => '09181234567',
            'middle_name' => fake()->lastName(), //should be  optional
            'civil_status' => CivilStatus::random()->value,
            'sex' => Sex::random()->value,
            'nationality' => Nationality::random()->value,
            'date_of_birth' => fake()->date(),
        ])
    ];
});

test('customer can accept addresses', function (Customer $contact) {
    $contact->addresses = json_encode([
        [
            'type' => AddressType::default(),
            'ownership' => Ownership::random(),
            'address1' => fake()->address(),
            'locality' => fake()->city(),
            'administrative_area' => fake()->randomElement(['NCR', 'Metro Manila', 'Cebu']),
            'postal_code' => fake()->postcode(),
            'region' => fake()->word(),
            'country' => 'PH',
        ]
    ]);
    expect($contact->addresses)->toBeInstanceOf(DataCollection::class);
    expect($contact->addresses->first())->toBeInstanceOf(AddressMetadata::class);
})->with('customer');

test('contact can accept employment', function (Customer $contact) {
    $contact->employment = [
        [
            'type' => Employment::default()->value,
            'monthly_gross_income' => 100000,
            'employment_status' => EmploymentStatus::default()->value,
            'employer' => [
                "name" => "3neti",
                "email" => "lester@hurtado.ph",
                "address" => [
                    "type" => "Primary",
                    "region" => "NCR",
                    "country" => "PH",
                    "address1" => "8 West Maya Drive, Philam Homes, QC",
                    "locality" => "Pasig City",
                    "ownership" => "Owned",
                    "postal_code" => "1400",
                    "administrative_area" => "Metro Manila"
                ],
                "industry" => Industry::random()->value,
                "contact_no" => '',
                "nationality" => Nationality::random()->value
            ],
            'employment_type' => EmploymentType::default()->value,
            'current_position' => null,
            'id' =>  [
                'tin' => '123-456-789'
            ]
        ]
    ];
    $contact->save();
    expect($contact->employment)->toBeInstanceOf(DataCollection::class);
    expect($contact->employment->first())->toBeInstanceOf(EmploymentMetadata::class);
})->with('customer');

test('contact can accept spouse', function (Customer $contact) {
    $contact->spouse = [
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->email(),
        'mobile' => '09181234567',
        'middle_name' => '',
        'civil_status' => CivilStatus::random()->value,
        'sex' => Sex::random()->value,
        'nationality' => Nationality::random()->value,
        'date_of_birth' => fake()->date(),
    ];
    $contact->save();
    expect($contact->spouse)->toBeInstanceOf(SpouseMetadata::class);
})->with('customer');

test('contact can accept aif', function (Customer $contact) {
    $contact->aif = [
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->email(),
        'mobile' => '09181234567',
        'middle_name' => '',
        'civil_status' => CivilStatus::random()->value,
        'sex' => Sex::random()->value,
        'nationality' => Nationality::random()->value,
        'date_of_birth' => fake()->date(),
    ];
    $contact->save();
    expect($contact->aif)->toBeInstanceOf(AIFMetadata::class);
})->with('customer');

test('contact can accept co-borrowers', function (Customer $contact) {
    $contact->co_borrowers = json_encode([
        [
            'type' => CoBorrowerType::PRIMARY->value,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'mobile' => '09181234567',
            'middle_name' => '',
            'civil_status' => CivilStatus::random()->value,
            'sex' => Sex::random()->value,
            'nationality' => Nationality::random()->value,
            'date_of_birth' => fake()->date(),
            'employment' => [
                [
                    'type' => Employment::default()->value,
                    'monthly_gross_income' => 100000,
                    'employment_status' => EmploymentStatus::default()->value,
                    'employer' => '',
                    'employment_type' => null,
                    'current_position' => null,
                    'id' => [
                        'tin' => fake()->uuid()
                    ]
                ]
            ],
            'addresses' => [
                [
                    'type' => AddressType::default(),
                    'ownership' => Ownership::random(),
                    'address1' => fake()->address(),
                    'locality' => fake()->city(),
                    'administrative_area' => fake()->randomElement(['NCR', 'Metro Manila', 'Cebu']),
                    'postal_code' => fake()->postcode(),
                    'region' => fake()->word(),
                    'country' => 'PH',
                ]
            ]
        ]
    ]);
    $contact->save();
    expect($contact->co_borrowers)->toBeInstanceOf(DataCollection::class);
    expect($contact->co_borrowers->first())->toBeInstanceOf(CoBorrowerMetadata::class);
})->with('customer');
