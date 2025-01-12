<?php

use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Homeful\Contacts\Classes\ContactMetaData;
use Homeful\Contacts\Models\Contact;

uses(RefreshDatabase::class, WithFaker::class);

beforeEach(function () {
    $this->faker = $this->makeFaker('en_PH');
    $migration = include 'vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
    $migration->up();
});

test('contact metadata from contact model', function () {
    $contact = Contact::factory()->create();
    $data = ContactMetaData::fromModel($contact);
    expect($data)->toBeInstanceOf(ContactMetaData::class);
});
