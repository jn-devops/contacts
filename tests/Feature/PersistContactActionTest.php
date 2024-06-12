<?php

use Homeful\Contacts\Actions\PersistContactAction;
use Homeful\Contacts\Data\ContactData;
use Homeful\Contacts\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;

uses(RefreshDatabase::class, WithFaker::class);

beforeEach(function () {
    $this->faker = $this->makeFaker('en_PH');
    $migration = include 'vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
    $migration->up();
});

dataset('attribs', function () {
    return [
        fn () => [
            'reference_code' => $this->faker->word(),

            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annuled/Divorced', 'Legally Seperated', 'Widow/er']),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'nationality' => 'Filipino',
            'date_of_birth' => $this->faker->date(),
            'email' => $this->faker->email(),
            'mobile' => $this->faker->phoneNumber(),
            'spouse' => [
                'first_name' => $this->faker->firstName(),
                'middle_name' => $this->faker->lastName(),
                'last_name' => $this->faker->lastName(),
                'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annuled/Divorced', 'Legally Seperated', 'Widow/er']),
                'sex' => $this->faker->randomElement(['Male', 'Female']),
                'nationality' => 'Filipino',
                'date_of_birth' => $this->faker->date(),
                'email' => $this->faker->email(),
                'mobile' => $this->faker->phoneNumber(),
            ],
            'addresses' => [
                [
                    'type' => 'primary',
                    'ownership' => $this->faker->word(),
                    'address1' => $this->faker->address(),
                    'locality' => $this->faker->city(),
                    'postal_code' => $this->faker->postcode(),
                    'country' => 'PH',
                ],
                [
                    'type' => 'secondary',
                    'ownership' => $this->faker->word(),
                    'address1' => $this->faker->address(),
                    'locality' => $this->faker->city(),
                    'postal_code' => $this->faker->postcode(),
                    'country' => 'PH',
                ],
            ],
            'employment' => [
                'employment_status' => $this->faker->word(),
                'monthly_gross_income' => $this->faker->word(),
                'current_position' => $this->faker->word(),
                'employment_type' => 'regular',
                'employer' => [
                    'name' => $this->faker->word(),
                    'industry' => $this->faker->word(),
                    'nationality' => $this->faker->word(),
                    'address' => [
                        'type' => 'work',
                        'ownership' => $this->faker->word(),
                        'address1' => $this->faker->address(),
                        'locality' => $this->faker->city(),
                        'postal_code' => $this->faker->postcode(),
                        'country' => 'PH',
                    ],
                    'contact_no' => $this->faker->word(),
                ],
                'id' => [
                    'tin' => $this->faker->word(),
                    'pagibig' => $this->faker->word(),
                    'sss' => $this->faker->word(),
                    'gsis' => $this->faker->word(),
                ],
            ],
            'co_borrowers' => [
                [
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
                    'sex' => $this->faker->randomElement(['Male', 'Female']),
                    'nationality' => 'Filipino',
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $this->faker->phoneNumber(),
                ],
                [
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
                    'sex' => $this->faker->randomElement(['Male', 'Female']),
                    'nationality' => 'Filipino',
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $this->faker->phoneNumber(),
                ],
            ],
            'order' => [
                'sku' => $this->faker->word(),
                'seller_commission_code' => $this->faker->word(),
                'property_code' => $this->faker->word(),
            ],
        ],
    ];
});

test('persist contact action', function (array $attribs) {
    expect(Contact::count())->toBe(0);
    $original_queries_count = 2;
    $image_query_count = 0; //5;
    $contact_query_count = 1;
    $data_query_count = 1;
    $queries_count = $original_queries_count + $image_query_count + $contact_query_count + $data_query_count;
    \Pest\Laravel\expectsDatabaseQueryCount($queries_count);
    $action = app(PersistContactAction::class);
    $contact = $action->run($attribs);
    expect(Contact::count())->toBe(1);
    expect($contact)->toBeInstanceOf(Contact::class);
    expect($contact->toData())->toBe(ContactData::fromModel($contact)->toArray());
})->with('attribs')->skip();

//test('persist contact end point', function (array $attribs) {
//    $response = $this->postJson(route('persist-contact'), $attribs);
//    $response->assertStatus(200);
//    $search = Arr::only($attribs, ['first_name', 'middle_name', 'last_name']);
//    $contact = app(Contact::class)->where($search)->first();
//    $response->assertJson(['code' => $contact->reference_code, 'status' => 1]);
//})->with('attribs')->skip();
