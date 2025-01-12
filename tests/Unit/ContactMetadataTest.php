<?php

use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Homeful\Contacts\Actions\GetContactMetadataFromContactModel;
use Homeful\Contacts\Classes\ContactMetaData;
use Homeful\Contacts\Facades\Contacts;
use Homeful\Contacts\Models\Contact;

uses(RefreshDatabase::class, WithFaker::class);

beforeEach(function () {
    $this->faker = $this->makeFaker('en_PH');
    $migration = include 'vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
    $migration->up();
});

test('contact metadata from contact factory using action', function () {
    $contact = Contact::factory()->create();
    $data = app(GetContactMetadataFromContactModel::class)->run($contact);
    expect($data)->toBeInstanceOf(ContactMetaData::class);
});

test('contact metadata from contact model using action', function () {
    $contact = Contact::create([
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'date_of_birth' => fake()->date(),
        'email' => fake()->email(),
        'mobile' => '09171234567',
    ]);
    $data = app(GetContactMetadataFromContactModel::class)->run($contact);
    expect($data)->toBeInstanceOf(ContactMetaData::class);
});

test('contact metadata from contact factory using facade', function () {
    $contact = Contact::factory()->create();
    $data = Contacts::fromContactModelToContactMetadata($contact);
    expect($data)->toBeInstanceOf(ContactMetaData::class);
});

