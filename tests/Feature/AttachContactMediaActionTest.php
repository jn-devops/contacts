<?php

use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Homeful\Contacts\Actions\AttachContactMediaAction;
use Homeful\Contacts\Models\Contact;

uses(RefreshDatabase::class, WithFaker::class);

beforeEach(function () {
    $this->faker = $this->makeFaker('en_PH');
    $migration = include 'vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
    $migration->up();
});

dataset('contact', function () {
    return [
        [fn () => Contact::factory()->create(['idImage' => null, 'selfieImage' => null, 'payslipImage' => null])]
    ];
});

test('attach contact media action works', function (Contact $contact) {
    $attribs = [
        'idImage' => 'https://jn-img.enclaves.ph/Test/idImage.jpg',
        'selfieImage' => 'https://jn-img.enclaves.ph/Test/selfieImage.jpg',
        'payslipImage' => 'https://jn-img.enclaves.ph/Test/payslipImage.jpg',
        'voluntarySurrenderFormDocument' => 'https://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf',
        'usufructAgreementDocument' => 'https://jn-img.enclaves.ph/Microservices%20Logo/Level%200%20-Book%20Flight_Property.pdf',
        'contractToSellDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'deedOfRestrictionsDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'disclosureDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'borrowerConformityDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'statementOfAccountDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'invoiceDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'receiptDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'deedOfSaleDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
    ];
    $contact = app(AttachContactMediaAction::class)->run($contact, $attribs);
    expect($contact->idImage)->toBeInstanceOf(Media::class);
    expect($contact->selfieImage)->toBeInstanceOf(Media::class);
    expect($contact->payslipImage)->toBeInstanceOf(Media::class);
    expect($contact->idImage->name)->toBe('idImage');
    expect($contact->idImage->file_name)->toBe('idImage.jpg');
    expect($contact->selfieImage->name)->toBe('selfieImage');
    expect($contact->selfieImage->file_name)->toBe('selfieImage.jpg');
    expect($contact->payslipImage->name)->toBe('payslipImage');
    expect($contact->payslipImage->file_name)->toBe('payslipImage.jpg');
    expect($contact->uploads)->toBe([
        [
            'name' => $contact->idImage->name,
            'url' => $contact->idImage->getUrl()
        ],
        [
            'name' => $contact->selfieImage->name,
            'url' => $contact->selfieImage->getUrl()
        ],
        [
            'name' => $contact->payslipImage->name,
            'url' => $contact->payslipImage->getUrl()
        ],
        [
            'name' => $contact->voluntarySurrenderFormDocument->name,
            'url' => $contact->voluntarySurrenderFormDocument->getUrl()
        ],
        [
            'name' => $contact->usufructAgreementDocument->name,
            'url' => $contact->usufructAgreementDocument->getUrl()
        ],
        [
            'name' => $contact->contractToSellDocument->name,
            'url' => $contact->contractToSellDocument->getUrl()
        ],
        [
            'name' => $contact->deedOfRestrictionsDocument->name,
            'url' => $contact->deedOfRestrictionsDocument->getUrl()
        ],
        [
            'name' => $contact->disclosureDocument->name,
            'url' => $contact->disclosureDocument->getUrl()
        ],
        [
            'name' => $contact->borrowerConformityDocument->name,
            'url' => $contact->borrowerConformityDocument->getUrl()
        ],
        [
            'name' => $contact->statementOfAccountDocument->name,
            'url' => $contact->statementOfAccountDocument->getUrl()
        ],
        [
            'name' => $contact->invoiceDocument->name,
            'url' => $contact->invoiceDocument->getUrl()
        ],
        [
            'name' => $contact->receiptDocument->name,
            'url' => $contact->receiptDocument->getUrl()
        ],
        [
            'name' => $contact->deedOfSaleDocument->name,
            'url' => $contact->deedOfSaleDocument->getUrl()
        ],
    ]);
    $contact->idImage->delete();
    $contact->selfieImage->delete();
    $contact->payslipImage->delete();
    $contact->clearMediaCollection('id-images');
    $contact->clearMediaCollection('selfie-images');
    $contact->clearMediaCollection('payslip-images');
})->with('contact');

test('attach contact media action has an endpoint', function (Contact $contact) {
    $attribs = [
        'idImage' => 'https://jn-img.enclaves.ph/Test/idImage.jpg',
        'selfieImage' => 'https://jn-img.enclaves.ph/Test/selfieImage.jpg',
        'payslipImage' => 'https://jn-img.enclaves.ph/Test/payslipImage.jpg',
        'voluntarySurrenderFormDocument' => 'https://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf',
        'usufructAgreementDocument' => 'https://jn-img.enclaves.ph/Microservices%20Logo/Level%200%20-Book%20Flight_Property.pdf',
        'contractToSellDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'deedOfRestrictionsDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'disclosureDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'borrowerConformityDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'statementOfAccountDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'invoiceDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'receiptDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'deedOfSaleDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
    ];
    $response = $this->post(route('attach-contact-media', ['reference_code' => $contact->reference_code]), $attribs);
    $response->assertStatus(200);

    expect($contact->idImage)->toBeInstanceOf(Media::class);
    expect($contact->selfieImage)->toBeInstanceOf(Media::class);
    expect($contact->payslipImage)->toBeInstanceOf(Media::class);
    expect($contact->idImage->name)->toBe('idImage');
    expect($contact->idImage->file_name)->toBe('idImage.jpg');
    expect($contact->selfieImage->name)->toBe('selfieImage');
    expect($contact->selfieImage->file_name)->toBe('selfieImage.jpg');
    expect($contact->payslipImage->name)->toBe('payslipImage');
    expect($contact->payslipImage->file_name)->toBe('payslipImage.jpg');

    expect($contact->uploads)->toBe(
        [
            [
                'name' => $contact->idImage->name,
                'url' => $contact->idImage->getUrl()
            ],
            [
                'name' => $contact->selfieImage->name,
                'url' => $contact->selfieImage->getUrl()
            ],
            [
                'name' => $contact->payslipImage->name,
                'url' => $contact->payslipImage->getUrl()
            ],
            [
                'name' => $contact->voluntarySurrenderFormDocument->name,
                'url' => $contact->voluntarySurrenderFormDocument->getUrl()
            ],
            [
                'name' => $contact->usufructAgreementDocument->name,
                'url' => $contact->usufructAgreementDocument->getUrl()
            ],
            [
                'name' => $contact->contractToSellDocument->name,
                'url' => $contact->contractToSellDocument->getUrl()
            ],
            [
                'name' => $contact->deedOfRestrictionsDocument->name,
                'url' => $contact->deedOfRestrictionsDocument->getUrl()
            ],
            [
                'name' => $contact->disclosureDocument->name,
                'url' => $contact->disclosureDocument->getUrl()
            ],
            [
                'name' => $contact->borrowerConformityDocument->name,
                'url' => $contact->borrowerConformityDocument->getUrl()
            ],
            [
                'name' => $contact->statementOfAccountDocument->name,
                'url' => $contact->statementOfAccountDocument->getUrl()
            ],
            [
                'name' => $contact->invoiceDocument->name,
                'url' => $contact->invoiceDocument->getUrl()
            ],
            [
                'name' => $contact->receiptDocument->name,
                'url' => $contact->receiptDocument->getUrl()
            ],
            [
                'name' => $contact->deedOfSaleDocument->name,
                'url' => $contact->deedOfSaleDocument->getUrl()
            ],
        ]
    );
    $contact->idImage->delete();
    $contact->selfieImage->delete();
    $contact->payslipImage->delete();
    $contact->clearMediaCollection('id-images');
    $contact->clearMediaCollection('selfie-images');
    $contact->clearMediaCollection('payslip-images');
})->with('contact');

